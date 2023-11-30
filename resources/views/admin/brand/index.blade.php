<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brand') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <span class="text-success">
                    {{ session('success') }}
                </span>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td>
                                        <img src={{ asset($brand->brand_image) }}>
                                    </td>
                                    <td>{{ $brand->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-primary">
                                            Edit
                                        </a>
                                    </td>
                                    <td>
                                        <form method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $brands->links() }}
                </div>
                <div class="col-md-4">
                    <form action={{ route('brand.add') }} method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="brand_name">Brand Name</label>
                            <input type="text" class="form-control" id="brand_name" name="brand_name"
                                placeholder="Brand Name">
                            @error('brand_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <label for="brand_image">Brand Image</label>
                            <input type="file" id="brand_image" name="brand_image">
                            @error('brand_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>