<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use Illuminate\Support\Facades\Validator;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $professores = Professor::select('id', 'nome', 'ativo')
                ->get();

            return view('professor.index')
                ->with('professores', $professores);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('professor.create');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nome' => 'required|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $professor = new Professor();
            $professor->nome = $request->nome;
            $professor->save();

            session()->flash('status', 'O professor foi criado com sucesso!');
            return redirect()->route('professores.index');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $professor = Professor::select('id', 'nome', 'ativo')
                ->find($id);

            if (!$professor) {
                throw new Exception('O professor não foi encontrado.', 1);
            }

            return view('professor.edit')
                ->with('professor', $professor);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nome' => 'required|max:255',
                'radioStatus' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $professor = Professor::select('id')
                ->find($id);

            if (!$professor) {
                throw new Exception('O professor não foi encontrado.', 1);
            }

            $professor->nome = $request->nome;
            $professor->ativo = $request->radioStatus;
            $professor->save();

            session()->flash('status', 'O professor foi salvo com sucesso!');
            return redirect()->route('professores.index');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $professor = Professor::select('id')
                ->find($id);

            if (!$professor) {
                throw new Exception('O professor não foi encontrado.', 1);
            }

            $professor->delete();

            session()->flash('success', 'O professor foi excluído com sucesso!');
            return response(200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
