<div class="widget widget-bg">
   <div class="heading">
      <h2 class="main-heading">Search here</h2>
      <span class="heading-ping"></span>
   </div>
   <div class="search-widget">
      <form action="{{route('search')}}" method="get">
         <div class="form-group">
            <input placeholder="Search Keyword" name="search" class="form-control" type="text">
            <button type="submit"> <i class="fa fa-search"></i></button>
         </div>
      </form>
   </div>
</div>
