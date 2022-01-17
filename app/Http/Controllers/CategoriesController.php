<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use files;
use App\Models\User;
use App\Models\Categories;
use Carbon\Carbon;
use DB;

class CategoriesController extends Controller
{
    private $categories;
    private $totalPage = 15;
    private $path = 'categories';   

    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }  

    public function index()
    {
        $categories = $this->categories->paginate($this->totalPage);
        return view('categories.index', compact ('categories'));   
    }

    public function store(Request $request)
    {
        
        DB::beginTransaction();

        $dataForm = $request->except('_token');

        // Verifica se informou a imagem para upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

        // Define finalmente o nome
        $nameFile = Str::slug($request->name) . '.' . $request->image->getClientOriginalExtension();
       

        // Faz o upload:
        $upload = $request->image->storeAs($this->path, $nameFile);
        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
        $dataForm['image'] = $upload;
        // Verifica se NÃO deu certo o upload
        if (!$upload)
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer o upload da imagem');


        }

        $insert = auth()->user()->categories()->create($dataForm);
                
        if ($insert){

            DB::commit();
        
            return redirect()
                        ->route ('categories.index')
                        ->with('success', 'A Nova Categoria foi Adicionado com Sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function destroy(Request $request)
    {
        $ids = $request->ids;
        DB::table("categories")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);
    }

    public function update_status(Request $request)
    {
        if ($request->ajax()){
            if (!empty($request->checkbox)) {            

                foreach ($request->checkbox as $checkbox) {
                    $categories          = Categories::find($checkbox);
                    $categories->status  = $request->status;
                    $categories->save();

                }
                
                return response()->json(['success'=>"A Categoria foi Deletada Com sussesso !"]);
            } else {
                return redirect()
                            ->back()
                            ->with('error', 'Ops, Deu algum erro' );
            }
        }
    }

    public function delete(Request $request)
    {
        if (!empty($request->checkbox)) {               
            Categories::destroy($request->checkbox);
            
            return response()->json(['success'=>"A Categoria foi Deletada Com sussesso !"]);
        } else {
            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }
    }
}

