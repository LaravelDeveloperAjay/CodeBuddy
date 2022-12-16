<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) 
    {
        $this->categoryRepository = $categoryRepository;
    }


    public function index()
    {
        $categories = $this->categoryRepository->getAllCategories();
        return view('categories.index', [
            'categories' => $categories
        ]);
    }
    public function dashboard()
    {
        $categories = $this->categoryRepository->getAllCategories();
        return view('admindashboard', [
            'categories' => $categories
        ]); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAllCategories();
        

        return view('categories.create', [
            'categories' => $categories
        ]);
        
        

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

        $this->validate($request, [
            'name' => 'required'
        ]);

        $categoryDetails = $request->only([
            'name',
            'parent_category_id'
        ]);
        
       $data =  $this->categoryRepository->createCategory($categoryDetails);

       if($data)
       {
        return redirect()->route('categories.index')
                        ->with('success','Category added successfully');

       }
    }
    catch (exception $e) {
        return redirect()->back()->with('error', 'failed');

    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = $this->categoryRepository->getAllCategories();       

        return view('categories.edit', [
            'categories' => $categories,
            'category' => $category
        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {

            $this->validate($request, [
                'name' => 'required'
            ]);
    
            $categoryDetails = $request->only([
                'name',
                'parent_category_id'
            ]);
            
           $data =  $this->categoryRepository->updateCategory($category->id, $categoryDetails);                  
    
           if($data)
           {
            return redirect()->route('categories.index')
                            ->with('success','Category updated successfully');
    
           }
        }
        catch (exception $e) {
            return redirect()->back()->with('error', 'failed');
    
        }
    
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
        $categoryId = $category->id;

        $this->categoryRepository->deletecategory($categoryId);
        return redirect()->route('categories.index')
        ->with('success','Category deleted successfully');

}

catch (exception $e) {
return redirect()->back()->with('error', 'failed');

}


}
}
