<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function index()
  {
      $types = Type::all();
      $categories = Category::all();

      return view('category', compact('types', 'categories'));
  }

  public function create()
  {
      $types = Type::all();
      return view('category_create', compact('types'));
  }

  public function store(Request $request)
  {
      $this->validate($request, [
          'name' => 'string|required'
      ]);

      $category = new Category($request->all());
      //$category->name = $request->name;
      $category->save();
      //$category->recalculationHistories()->createMany(['']);

      return redirect()->route('category.index');
  }

  public function edit($id)
  {
      $types = Type::all();
      $category = Category::findorFail($id);

      return view('category_edit',compact('category','types'));
  }

  public function update(Request $request, $id)
  {
      $category_validate = $this->validate($request,[
          'name' => 'required|string',
          'type_id' => 'required|integer'
      ]);

    $category = Category::with('type')->find($id);
     if($category === null){
         return response()->json(['message' => 'Такой категорий не существует'], 404);
     }

     $category->update($category_validate);
     return redirect()->route('category.index')
         ->with(['success' => 'Успешно изменино!']);
  }

  public function delete($id)
  {
      $category = Category::query()->find($id);
      if($category === null) {
          return response()->json(['message' => 'Такой категорий не существует'], 404);
      }
      $category->delete();

      return redirect()->route('category.index');
  }
}

