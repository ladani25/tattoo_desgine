@include('admin.header')

<div class="page-content" style="padding-bottom: 70px;">
    <div class="block-body" style="padding-top:5%">
        <div class="card mb-4 container">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
            </div>
            
            <div class="container">
                <form id="edit-category-form" action="{{ url('edit_c/'.$categeroy->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
    
                    <div class="form-group">
                        <label for="c_name">Category Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $categeroy->name }}" required>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="order_no">Order No <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="number" class="form-control" id="order_no" name="order_no" value="{{ $categeroy->orde_no }}" required>
                        </div>
                    </div><br>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Featured/Premium <span class="text-danger"></span></label>
                        <div class="col-lg-8">
                            <label style="font-size: large;" for="is_feature">Featured
                                <input type="checkbox" id="is_feature" name="is_feature" {{ $categeroy->is_feature ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                &nbsp;&nbsp;&nbsp;
                                Premium
                            </label>
                            <label style="font-size: large;" for="is_premium">
                                <input type="checkbox" id="is_premium" name="is_premium" {{ $categeroy->is_premium ? 'checked' : '' }}>
                                <span class="checkmark1"></span>
                            </label>
                        </div>
                    </div><br>
                    
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="status">Status <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <label class="switch">
                                <input type="checkbox" id="is_active" name="is_active" {{ $categeroy->status ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div><br>

                    <div class="form-group">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="category_image">Category Image <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="file" class="form-control" accept="image/*" id="category_image" name="image[]" required multiple aria-required="true">   
                            </div>
                        </div><br>
                        @if($categeroy->images)
                            <div class="mt-2">
                                @foreach(explode(',', $categeroy->images) as $image)
                                    <img src="{{ asset('images/' . $image) }}" alt="Category Image" width="100">
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <!-- Other fields if needed -->
    
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')
