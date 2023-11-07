@extends('frontend.layouts.main')

@section('main-section')
    @push('title')
        <title>Home - Hassan Graphics & Printing</title>
    @endpush
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <!-- Upper Row: 4 Cards -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- Card 1: New Orders -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $order }}</h3>
                                <p>New Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ Route('orderView') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- Card 2: Bounce Rate -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $productcount }}<sup style="font-size: 20px"></sup></h3>
                                <p>Products</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ Route('productview') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- Card 3: User Registrations -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $user }}</h3>
                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>

                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- Card 4: Unique Visitors -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $customer }}</h3>
                                <p>Customers</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('customerview') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Lower Row: 2 Cards in 2 Columns -->
                <div class="row">
                    <div class="col-md-6">
                        <!-- Card 5: Latest Members -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Latest Members</h3>

                                <div class="card-tools">
                                    <span class="badge badge-danger">{{ $latestCustomers }} New Members</span>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i>
                                    </button>

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <ul class="users-list clearfix">
                                    @foreach ($customerdata as $customer)
                                        <li>
                                            <img src="{{ asset('frontend/dist/img/user1-128x128.jpg') }}" alt="User Image">
                                            <b class="users-list-name" href="#">{{ $customer->Name }}</b>
                                            <span
                                                class="users-list-date">{{ $customer->created_at->diffForHumans() }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <a href="{{ Route('customerview') }}">View All Users</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!--/.card -->
                    </div>



                    <div class="col-md-6">
                        <!-- Card 6: Calendar -->

                        <!-- Box Comment -->
                        <div class="card card-widget">
                            <div class="card-header">
                                <div class="user-block">
                                    <img class="img-circle" src="{{ asset('frontend/dist/img/avatar5.png') }}"
                                        alt="User Image">
                                    <span class="username"><a href="#">{{ Auth::user()->name }}</a></span>
                                    <span class="description">Admin </span>

                                </div>
                                <!-- /.user-block -->
                                <div class="card-tools">
                                    <span class="badge badge-success">Favourite Articles</span>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i>
                                    </button>

                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators (optional) -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#imageCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#imageCarousel" data-slide-to="1"></li>
                                        <li data-target="#imageCarousel" data-slide-to="2"></li>
                                        <!-- Add more indicators for additional images if needed -->
                                    </ol>

                                    <!-- Slides -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{ asset('frontend/dist/img/wedding1.jpg') }}"
                                                alt="Photo 1">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="{{ asset('frontend/dist/img/wedding2.jpg') }}" alt="Photo 2">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="{{ asset('frontend/dist/img/wedding3.jpg') }}" alt="Photo 3">
                                        </div>
                                        <!-- Add more slides for additional images if needed -->
                                    </div>

                                    <!-- Controls -->
                                    <a class="carousel-control-prev " href="#imageCarousel" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#imageCarousel" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer card-comments">

                                <!-- /.card-comment -->

                                <!-- /.card-comment -->
                            </div>
                            <!-- /.card-footer -->

                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Card 7: Recently Added Products -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recently Added Products</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                              </button> -->
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    @foreach ($product as $productdata)
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="{{ asset('frontend/dist/img/images.jpg') }}"
                                                    alt="Product Image" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)"
                                                    class="product-title">{{ $productdata->Name }}
                                                    <span
                                                        class="badge badge-warning float-right">PKR-{{ $productdata->Rate }}/-</span></a>
                                                <span class="product-description">
                                                    <strong>{{ $productdata->Disc ? 'Discount: ' . $productdata->Disc . '%' : '' }}</strong>{{ $productdata->Disc ? ' | ' : '' }}
                                                    <strong>{{ $productdata->SqrFt ? 'Size: ' . $productdata->SqrFt . 'cm' : '' }}</strong>
                                                </span>
                                            </div>
                                        </li>
                                        <!-- /.item -->
                                    @endforeach
                                    <!-- /.item -->
                                </ul>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <a href="{{ Route('productview') }}" class="uppercase">View All Products</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>

                    </div>
                    <div class="col-md-6">
                        <!-- Card 8: Latest Orders -->
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Latest Orders</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Order ID</th>
                                                <th class="text-center">Item</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderdata as $order)
                                                <tr>
                                                    <td class="text-center">{{ $order->id }}</td>

                                                    <td class="text-center">
                                                        {{ $order->name ? $order->name : ' ' }}</td>

                                                    <td class="text-center"><span
                                                            class="badge badge-danger">{{ $order->quantity }}</span></td>
                                                    <td class="text-center">
                                                        <div class="sparkbar" data-color="#f56954" data-height="20">
                                                            {{ $order->total }}</div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <a href="{{ Route('orderView') }}" class="uppercase">View All Orders</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>










    <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var currentImage = 0;
            var images = $(".card-slider img");
            var imageCount = images.length;

            function showImage(index) {
                images.hide();
                images.eq(index).show();
            }

            // Initialize with the first image.
            showImage(currentImage);

            // Create a function to handle sliding to the next image.
            function slideNext() {
                currentImage = (currentImage + 1) % imageCount;
                showImage(currentImage);
            }

            // Create a function to handle sliding to the previous image.
            function slidePrev() {
                currentImage = (currentImage - 1 + imageCount) % imageCount;
                showImage(currentImage);
            }

            // Add event listeners for next and previous buttons (you can customize this part).
            $("#nextButton").click(slideNext);
            $("#prevButton").click(slidePrev);
        });
    </script>
@endsection
