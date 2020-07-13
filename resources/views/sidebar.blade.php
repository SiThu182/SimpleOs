<ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/head/dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('category.index')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>Category</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('brand.index')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>Brand</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('item.index')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>Item</span></a>
      </li>
      @if(Auth::check() && (Auth::user()->role=='head' || Auth::user()->role=='admin'))
       
      <li class="nav-item">
        <a class="nav-link" href="{{route('user.index')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>User</span></a>
      </li>
        
      @endif

      @if(Auth::check() && Auth::user()->role=='admin')
      <li class="nav-item">
        <a class="nav-link" href="{{route('product.index')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>Product</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('category.index')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>Category</span></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="{{route('price.index')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>Price</span></a>
      </li>
      @endif

      @if(Auth::check() && (Auth::user()->role=='head' || Auth::user()->role=='agent') )
      <li class="nav-item">
        <a class="nav-link" href="{{route('order.index')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>Order</span></a>
      </li>
      @endif
      @if(Auth::check() && (Auth::user()->role=='admin' || Auth::user()->role=='head'))
      <li class="nav-item">
        <a class="nav-link" href="{{route('orderReturn.index')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>Order Return</span></a>
      </li>
      
      @endif
      @if(Auth::check() && (Auth::user()->role=='admin' || Auth::user()->role=='head'))
       <li class="nav-item">
        <a class="nav-link" href="{{route('orderRequest.index')}}">
          <i class="fas fa-fw fa-table"></i>
          <span> Order Request</span></a>
      </li>
     @endif
    </ul>
