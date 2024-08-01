@include('admin.header')

<div class="page-content" style="padding-bottom: 70px;">
    <div>
        <div class="block-body" style="padding-top:5%">
            <div class="card mb-4 container">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add Tattoo</h6>
                </div>
                <div class="card-body container">
                    <form class="form-valide" action="{{ url('get_tattoo') }}" method="POST" enctype="multipart/form-data" novalidate="novalidate">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="category_id">Category Name<span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <select name="category_id" id="category_id" class="form-control" required>
                                    @foreach($categeroy as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="image">Tattoo Image <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="file" class="form-control" name="image[]" id="image" accept="image/*" multiple required>
                            </div>
                        </div><br>
        
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="">Popular/Featured <span class="text-danger"></span></label>
                            <div class="col-lg-8">
                                <label style="font-size: large;" for="is_popular">Popular
                                    <input type="checkbox" id="is_popular" name="is_popular">
                                </label>
                                &nbsp;&nbsp;&nbsp;
                                <label style="font-size: large;" for="is_featured">Featured
                                    <input type="checkbox" id="is_featured" name="is_featured">
                                </label>
                            </div>
                        </div><br>
                        
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="checkbox">
                                    <span class="text-danger"><p style="font-weight: bold;color:red;text-align:center;"></p></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row pt-3 border-top">
                            <div class="col-lg-8"></div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" name="submit" class="btn btn-primary" style="width: 100%;">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')
