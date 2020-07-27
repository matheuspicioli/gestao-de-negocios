<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLancamentoRequest;
use App\Models\Lancamento;
use App\Models\Item;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LancamentosController extends Controller
{
    public function index()
    {
        $lancamentos    = Lancamento::where('usuario_id', Auth::user()->id)->get();
        $itens          = collect(['Selecione um produto']);
        $itens          = $itens->merge(
            Item::where('quantidade', '>=', 1)->get()->pluck('nome', 'id')->toArray()
        )->toArray();

        return view('lancamentos.index')
            ->with('lancamentos', $lancamentos)
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

            $lancamento = Lancamento::create([
                'tipo'          => $request->get('tipo'),
                'usuario_id'    => $request->get('usuario_id'),
            ]);

            $itens->each(function ($item) {
                $itemEloquent = Item::findOrFail($item['id']);
                if ($item['quantidade'] > $itemEloquent->quantidade) {
                    throw new HttpResponseException(response()->json([
                        'message' => 'Não possui quantidade em estoque'
                    ], Response::HTTP_BAD_REQUEST));
                }
                $itemEloquent->quantidade -= $item['quantidade'];
                $itemEloquent->save();
            });

            $lancamento->itens()->attach($itens->map(function ($item) use ($lancamento) {
                return [
                    'item_id'       => $item['id'],
                    'lancamento_id' => $lancamento->id,
                    'quantidade'    => $item['quantidade']
                ];
            }));

            DB::commit();

            return response()->json($request->all());
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function edit($id)
    {
        try {
            $lancamento     = Lancamento::findOrFail($id);
            $itensSelected  = $lancamento->itens->map(function (Item $item) {
                return $item->id;
            })->toArray();
            $itens          = Item::all()->pluck('nome', 'id')->toArray();

            return view('lancamentos.edit')
                ->with('lancamento', $lancamento)
                ->with('itens', $itens)
                ->with('itensSelected', $itensSelected);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $lancamento = Lancamento::findOrFail($id);
        $lancamento->itens()->sync($request->get('items'));
        $lancamento->update($request->all());

        return redirect()->route('lancamentos.listar');
    }

    public function destroy($id)
    {
        $lancamento = Lancamento::findOrFail($id);
        $lancamento->delete();

        return redirect()->route('lancamentos.listar');
    }
}
