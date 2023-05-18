<x-default-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles >
        
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

    <div class="row layout-top-spacing">

    </div>
    
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-default-layout>