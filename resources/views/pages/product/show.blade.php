<x-default-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/filepond/filepond.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/FilePondPluginImagePreview.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/tagify/tagify.css')}}">

        @vite(['resources/scss/light/assets/forms/switches.scss'])
        @vite(['resources/scss/light/plugins/editors/quill/quill.snow.scss'])
        @vite(['resources/scss/light/plugins/tagify/custom-tagify.scss'])
        @vite(['resources/scss/light/plugins/filepond/custom-filepond.scss'])
        @vite(['resources/scss/light/assets/apps/ecommerce-create.scss'])

        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->
    <x-slot:sideBar>

        <!--  BEGIN LOADER  -->
        <x-layout-overlay/>
        <!--  BEGIN SIDEBAR  -->
        
        <x-menu.vertical-menu/>
        <x-navbar.style-vertical-menu/>.
        <!--  END SIDEBAR  --> 

    </x-slot:sideBar>

    @if (isset($product->id))
    <div class="row mb-4 layout-spacing layout-top-spacing">
        <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="widget-content widget-content-area ecommerce-create-section">
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label>Name</label>
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Product Name" value="{{$product->descriptions()->first()->name}}">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label>Description</label>
                        <div id="product-description">
                            {{strip_tags($product->descriptions()->first()->description)}}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="col-xxl-3 col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="row">
                <div class="col-xxl-12 col-xl-8 col-lg-8 col-md-7 mt-xxl-0 mt-4">
                    <div class="widget-content widget-content-area ecommerce-create-section">
                        <div class="row">
                            <div class="col-xxl-12 mb-4">
                                <div class="switch form-switch-custom switch-inline form-switch-secondary">
                                    <input 
                                    class="switch-input" 
                                    type="checkbox" 
                                    role="switch" 
                                    id="product-status" 
                                    @if ($product->status == 1)
                                    checked
                                    @endif
                                    >
                                    <label class="switch-label" for="product-status">Status</label>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-6 mb-4">
                                <label for="proCode">Product Code (model)</label>
                                <input type="text" class="form-control" id="proCode" value="{{$product->model}}">
                            </div>
                            <div class="col-xxl-12 col-md-6 mb-4">
                                <label for="proSKU">Product SKU</label>
                                <input type="text" class="form-control" id="proSKU" value="{{$product->sku}}">
                            </div>
                            <div class="col-xxl-12 col-md-6 mb-4">
                                <label for="proEAN">Product EAN</label>
                                <input type="text" class="form-control" id="proEAN" value="{{$product->ean}}">
                            </div>
                            <div class="col-xxl-12 col-md-6 mb-4">
                                <label for="proSKU">Product MPN</label>
                                <input type="text" class="form-control" id="proMPN" value="{{$product->mpn}}">
                            </div>

                            <div class="col-xxl-12 col-md-6 mb-4">
                                <label for="category">Category (id)</label>
                                <input 
                                type="text" 
                                class="form-control" 
                                id="category" 
                                value="{{$category?->descriptions()?->first()->name}} ({{$category?->descriptions()?->first()->id}})"
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12 col-xl-4 col-lg-4 col-md-5 mt-4">
                    <div class="widget-content widget-content-area ecommerce-create-section">
                        <div class="row">
                            <div class="col-sm-12 mb-4">
                                <label for="regular-price">Quantity</label>
                                <input type="text" class="form-control" id="regular-price" value="{{$product->quantity}}">
                            </div>
                            <div class="col-sm-12 mb-4">
                                <label for="regular-price">Regular Price</label>
                                <input type="text" class="form-control" id="regular-price" value="{{$product->price}}">
                            </div>
                            <div class="col-sm-12 mb-4">
                                <label for="weight">Weight</label>
                                <input type="text" class="form-control" id="weight" value="{{$product->weight}}">
                            </div>

                            <div class="col-sm-12">
                                <button class="btn btn-success w-100" disabled>Save Changes</button>
                            </div>
                        </div>                                            
                    </div>
                </div>
            </div>
        </div>

    </div>
    @else

    @endif

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{asset('plugins/editors/quill/quill.js')}}"></script>
        <script src="{{asset('plugins/tagify/tagify.min.js')}}"></script>
        @vite(['resources/assets/js/apps/ecommerce-create.js'])
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-default-layout>