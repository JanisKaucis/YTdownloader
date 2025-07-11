<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>YT Downloader</title>
</head>
<body>
<div class="flex flex-row min-h-screen justify-center items-center mx-2">
    <div class="w-3xl">
        <div class="flex mb-4 justify-center items-center">
            <h2 class="text-3xl">Youtube Video Downloader</h2>
        </div>
        <div class="">
            <form method="POST" action="{{ route('downloadYoutube') }}">
                @csrf
                <div class="flex gap-2">
                    <div class="mt-2 w-full">
                        <input type="text" name="url" placeholder="https://youtube.com/watch?v=URL"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                        @error('url')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit"
                            class="cursor-pointer rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                        Download
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
