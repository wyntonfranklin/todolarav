@extends("dashboard")

@section("content")
<!-- session message -->
@if(session()->has("message"))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session()->get("message") }}</span>
    </div>
@endif
    <div class="mt-1 py-1 px-1 sm:py-2 sm:px-2 lg:max-w-7xl lg:px-8">
        <h1 class="fs-2">Products</h1>
        <a href="{{ route("home.index") }}" class="text-sm">Back to home</a>
    </div>
    <div class="bg-white">
        <div class="mx-auto max-w-2xl py-2 px-2 sm:py-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <!-- loop through files -->
            <?php $counter = 1; ?>
            @foreach($files as $file)
                @if($counter == 1)
                    <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                @endif
                <a target="_blank" href="{{ $file["file"] }}" class="group">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                        <img src="{{$file["file"]}}" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-center group-hover:opacity-75">
                    </div>
                    <h3 class="mt-4 text-sm text-gray-700">Earthen Bottle</h3>
                    <p class="mt-1 text-lg font-medium text-gray-900">$48</p>
                </a>
                @if($counter % 4 == 0)
                    </div>
                    <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                @endif
                <?php $counter++; ?>
            @endforeach
        </div>
                <!-- form button post-->
        <form action="{{ route("home.delete") }}" method="post">
            @csrf
            <input type="hidden" name="remove" value="true">
            <button type="submit" class="rounded-sm inline-block text-center w-full p-1 bg-red-600 duration-500 text-white/80 text-xl font-semibold hover:bg-red-700 hover:text-white">
                Remove Files
            </button>
        </form>
    </div>

@endsection
