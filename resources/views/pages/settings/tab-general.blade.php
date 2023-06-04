
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">      
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif                          
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <h4>Online Store</h4>
                    </div>
                    <div class="col-sm-6 col-12">
                        <h4>ERP</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form method="post" action= "/dashboard/settings/general">
                    {{ csrf_field() }}
                    <div class="row">
                    <div class="col-6">
                        
                        <div class="form-group mb-4 col-8">
                            <label for="formGroupExampleInput">URL Store</label>
                            <input 
                            type="text"
                            name='general[store.url]'
                            value=@if (isset($general['store.url'])) {{$general['store.url']}} @else "" @endif
                            required 
                            class="form-control" 
                            id="formGroupExampleInput" 
                            placeholder="URL Store">
                        </div>
                        <div class="form-group mb-4 col-8">
                            <label for="formGroupExampleInput2">API Key</label>
                            <input 
                            type="text" 
                            name='general[store.key]'
                            value=@if (isset($general['store.key'])) {{$general['store.key']}} @else "" @endif
                            required 
                            class="form-control" 
                            id="formGroupExampleInput2" 
                            placeholder="Api Key">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-4 col-8">
                            <label for="formGroupExampleInput">URL Erp</label>
                            <input 
                            type="text" 
                            name='general[erp.url]'
                            value=@if (isset($general['erp.url'])) {{$general['erp.url']}} @else "" @endif
                            required 
                            class="form-control" 
                            id="formGroupExampleInput" 
                            placeholder="URL Erp">
                        </div>
                        <div class="form-group mb-4 col-8">
                            <label for="formGroupExampleInput2">Erp Key</label>
                            <input 
                            type="text" 
                            name='general[erp.key]'
                            value=@if (isset($general['erp.key'])) {{$general['erp.key']}} @else "" @endif
                            required 
                            class="form-control" 
                            id="formGroupExampleInput2" 
                            placeholder="Erp Key">
                        </div>
                    </div>
                    </div>
                    <div class="col-12 d-flex justify-content-sm-end justify-content-center">
                        <input type="submit" value="Save" class="btn btn-dark">
                    </div>
                </form>
            </div>
        </div>
    </div>