@php $dash.='-- '; @endphp
@foreach($subcategories as $subcategory)
    <option value="{{$subcategory->id}}"  @if($category->parent_category_id == $subcategory->id) selected @endif>{{$dash}}{{$subcategory->name}}</option>
    @if(count($subcategory->children))
        @include('categories.subCategoryList-option',['subcategories' => $subcategory->children])
    @endif
@endforeach