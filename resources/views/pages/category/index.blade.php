<x-default-layout :scrollspy="true">

    <x-slot:pageTitle>
        
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        @vite(['resources/scss/light/assets/elements/custom-pagination.scss'])
        @vite(['resources/scss/light/assets/elements/alert.scss'])
        <link rel="stylesheet" href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}">
        @vite(['resources/scss/light/plugins/notification/snackbar/custom-snackbar.scss'])
        
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <x-slot:scrollspyConfig>
        data-bs-spy="scroll" data-bs-target="#navSection" data-bs-offset="100"
    </x-slot>
    
    <x-slot:sideBar>

        <!--  BEGIN LOADER  -->
        <x-layout-overlay/>
        <!--  BEGIN SIDEBAR  -->
        
        <x-menu.vertical-menu/>
        <x-navbar.style-vertical-menu/>.
        <!--  END SIDEBAR  --> 

    </x-slot:sideBar>

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Table</a></li>
                <li class="breadcrumb-item active" aria-current="page">categories</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    <div class="col-12 d-flex justify-content-sm-end justify-content-center">
        <div class="" id="erp-result"></div>
        <button class="btn btn-primary mb-2 me-4" id="getCategories">Get categories (ERP)</button>
        <button class="btn btn-primary mb-2 me-4" id="sendCategories">Send categories (Store)</button>
        {{-- <button class="btn btn-secondary mb-2 me-4">Secondary</button>    --}}
    </div>
    <div class="row layout-top-spacing">

        @if($categories->count())
         
        <div id="tableStriped" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                
                <div class="widget-content widget-content-area">
                    <div class="row">
                        <div class="col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center">
                            <div class="d-flex align-items-center mb-2 me-4">
                                Page: {{$categories->currentPage()}} Total items: {{$categories->total()}} 
                            </div>
                            <div class="btn-group  mb-2 me-4" role="group">
                                <button id="btndefault6" type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Items per page ({{$categories->perPage()}}) <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
                                <div class="dropdown-menu" aria-labelledby="btndefault6">
                                    <a href="{{$categories->getOptions()['path']}}?perPage=10" class="dropdown-item"><i class="flaticon-home-fill-1 mr-1"></i>10</a>
                                    <a href="{{$categories->getOptions()['path']}}?perPage=25" class="dropdown-item"><i class="flaticon-gear-fill mr-1"></i>25</a>
                                    <a href="{{$categories->getOptions()['path']}}?perPage=50" class="dropdown-item"><i class="flaticon-bell-fill-2 mr-1"></i>50</a>
                                    <a href="{{$categories->getOptions()['path']}}?perPage=100" class="dropdown-item"><i class="flaticon-dots mr-1"></i>100</a>
                                </div>
                            </div>

                        </div>

                    </div>
            
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="checkbox-area" scope="col">
                                        <div class="form-check form-check-primary">
                                            <input class="form-check-input" id="striped_parent_all" type="checkbox">
                                        </div>
                                    </th>
                                    <th scope="col">id</th>
                                    <th scope="col">erp category id</th>
                                    <th scope="col">name</th>
                                    <th class="text-center" scope="col">parent id</th>
                                    <th class="text-center" scope="col">date modified</th>
                                    <th class="text-center" scope="col">actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-primary">
                                            <input class="form-check-input striped_child" type="checkbox">
                                        </div>
                                    </td>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->erp_category_id}}</td>
                                    <td>
                                        <span class="table-inner-text">{{$category->descriptions->first()->name}}</span>
                                    </td>
                                    <td class="text-center">{{$category->parent_id}}</td>
                                    <td class="text-center">{{$category->updated_at}}</td>
                                    <td class="text-center">
                                        <div class="action-btns">
                                            <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="post-pagination">
                        <div class="pagination-no_spacing">
                            <ul class="pagination">
                                <li><a href="{{ $categories->previousPageUrl() }}" class="prev"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg></a></li>
                                <li><a href="{{ $categories->previousPageUrl() }}">{{ $categories->currentPage() - 1}}</a></li>
                                <li><a href="javascript:void(0);" disabled class="active">{{$categories->currentPage()}}</a></li>
                                <li><a href="{{ $categories->nextPageUrl() }}">{{ $categories->currentPage() + 1}}</a></li>
                                <li><a href="{{ $categories->nextPageUrl() }}" class="next"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @else
        <div class="widget-content widget-content-area">
            <div class="alert alert-light-warning alert-dismissible fade show border-0 mb-4" role="alert"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-bs-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Warning!</strong> No categories </div>
        </div>
        @endif
        
        </div>
    </div>
    
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
        {{-- <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script> --}}
        @vite(['resources/assets/js/components/notification/custom-snackbar.js'])
        @vite(['resources/assets/js/dashboard/get_categories.js'])
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>