<?php

namespace App\Http\Controllers;

use App\Enums\PaymentType;
use App\Helpers\Money;
use App\Http\Requests\StoreLancamentoRequest;
use App\Models\Entry;
use App\Models\Item;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntriesController extends Controller
{
    public function index()
    {
        $payments   = PaymentType::toSelectArray();
        $entries    = Entry::where('user_id', Auth::user()->id)->get();
        $itens      = collect(['Selecione um produto']);
        $itens      = $itens->union(
            Item::where('quantity', '>=', 1)->get()->pluck('code', 'id')->toArray()
        )->toArray();

        return view('lancamentos.index')
            ->with('entries', $entries)
            ->with('payments', $payments)
            ->with('itens', $itens);
    }

    public function create()
    {
        return view('lancamentos.create');
    }

    public function store(StoreLancamentoRequest $request)
    {
        DB::beginTransaction();

        try {
            $itens  = collect($request->get('itens'));

            $entry = Entry::create([
                'type'       => $request->get('type'),
                'user_id'    => $request->get('user_id'),
                'payment_id' => PaymentType::fromValue((int)$request->get('payment_id'))->value,
            ]);

            $itens->each(function (array $item) use ($entry) {
                $itemEloquent = Item::findOrFail($item['id']);

                if ($item['quantity'] > $itemEloquent->quantity) {
                    throw new HttpResponseException(response()->json([
                        'message' => 'Não possui quantidade em estoque'
                    ], Response::HTTP_BAD_REQUEST));
                }

                $itemEloquent->quantity -= $item['quantity'];
                $itemEloquent->save();
            });

            $entry->itens()->attach($itens->map(function ($item) use ($entry) {
                return [
                    'item_id'           => $item['id'],
                    'entry_id'          => $entry->id,
                    'quantity'          => $item['quantity'],
                    'value_recieved'    => Money::moneyToDatabase($item['valueRecieve']),
                    'total_value'       => Money::moneyToDatabase($item['totalValue']),
                    'value_change'      => Money::moneyToDatabase($item['valueChange']),
                ];
            }));

            DB::commit();

            return response()->json($request->all());
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function payments() {
        return response()->json(PaymentType::toSelectArray(), Response::HTTP_OK);
    }

    public function edit($id)
    {
        try {
            $entry          = Entry::findOrFail($id);
            $itensSelected  = $entry->itens->map(function (Item $item) {
                return $item->id;
            })->toArray();
            $itens          = Item::all()->pluck('name', 'id')->toArray();

            return view('lancamentos.edit')
                ->with('lancamento', $entry)
                ->with('itens', $itens)
                ->with('itensSelected', $itensSelected);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $entry = Entry::findOrFail($id);
        $entry->itens()->sync($request->get('items'));
        $entry->update($request->all());

        return redirect()->route('lancamentos.listar');
    }

    public function destroy($id)
    {
        $entry = Entry::findOrFail($id);
        $entry->delete();

        return redirect()->route('lancamentos.listar');
    }
}
