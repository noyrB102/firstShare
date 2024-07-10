<div>

    <div class="flex justify-between xjustify-center mx-auto max-w-5xl my-8">

        <!-- Left Side Panel Content -->
        <div class="hidden xmax-w-full xbg-green-400">
            <div class="border rounded-md p-10 pt-3">
                <ul class="space-y-5 tracking-wide font-medium">
                    <li class="nav-item">
                        <a wire:navigate.hover
                            class="nav-link  {{ Route::is('dashboard') ? 'text-white bg-primary rounded' : '' }}"
                            href="">
                            <span>Home</span></a>
                    </li>
                    {{-- <li class="nav-item">
                        <a wire:navigate.hover class="nav-link" href="#">
                            <span>Explore</span></a>
                    </li> --}}
                    <li class="nav-item">
                        <a wire:navigate.hover
                            class="nav-link  {{ Route::is('feed') ? 'text-white bg-primary rounded' : '' }}"
                            href="">
                            <span>Feed</span></a>
                    </li>
                    <li class="nav-item">
                        <a wire:navigate.hover
                            class="nav-link {{ Route::is('terms') ? 'text-white bg-primary rounded' : '' }}"
                            href="">
                            <span>Terms</span></a>
                    </li>
                    <li class="nav-item">
                        <a wire:navigate.hover class="nav-link" href="#">
                            <span>Support</span></a>
                    </li>
                    <li class="nav-item">
                        <a wire:navigate.hover class="nav-link" href="#">
                            <span>Settings</span></a>
                    </li>
                </ul>
            </div>
            {{-- <div class="card-footer text-center py-2">
                <a class="btn btn-link btn-sm" href="{{ route('profile') }}">View Profile </a>
            </div> --}}
        </div>

        <!-- Center Thoughts Content -->
        <div class="w-full xbg-yellow-400">
            <h5 class="my-3 text-center text-lg text-sky-500">Share Your Thoughts</h5>

            <div class="text-center">
                @guest
                    <a class="text-sm text-sky-500" href="{{ route('login') }}">Login to share</a>
                @endguest
            </div>
            <div x-data="{ maxLength: 500 }" class="mb-8 mx-auto max-w-md flex items-start space-x-4">
                @auth
                    <div class="min-w-0 flex-1">
                        <form wire:submit="add" class="relative">
                            <div
                                class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-sky-600">
                                <label for="comment" class="sr-only">Add your thoughts</label>
                                <textarea x-ref="message" @keyup="maxLength = 500 - $refs.message.value.length" rows="3" wire:model="content"
                                    id="comment" maxlength="500"
                                    class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="What's on your mind..."></textarea>

                                <div class="py-2" aria-hidden="true">
                                    <div class="py-px">
                                        <div class="h-9"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                                <div class="flex items-center space-x-5">

                                    <div class="xmt-4 flex text-sm leading-6 text-gray-600">
                                        @if (!$image)
                                            <div class="flex w-3/6 flex-col gap-2">
                                                <label for="file-upload"
                                                    class="relative cursor-pointer rounded-md hover:bg-white font-semibold text-gray-500 focus-within:outline-none xfocus-within:ring-2 xfocus-within:ring-sky-600 xfocus-within:ring-offset-2 hover:text-sky-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                        fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                                        <path
                                                            d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                                                    </svg>
                                                    <input wire:model="image" id="file-upload" name="file-upload"
                                                        type="file" class="sr-only">
                                                </label>

                                                @error('image')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @else
                                            @if (!$image)
                                                <span>Image type not able to preview</span>
                                            @else
                                                <img class="object-cover rounded-md w-10 h-10"
                                                    src="{{ $image->temporaryUrl() }}">
                                            @endif
                                        @endif
                                    </div>

                                </div>
                                <div class="mt-2">
                                    @error('content')
                                        <span class="text-sm text-red-700">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="flex-shrink-0">

                                    <button @click="maxLength = 500" type="submit"
                                        class="inline-flex items-center rounded-md bg-sky-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                                        Post
                                    </button>
                                </div>
                            </div>
                        </form>
                        <span x-text="maxLength +  ' characters remaining'"
                            class="px-2 text-sm text-gray-500 float-right"></span>
                    </div>
                @endauth

            </div>
            <div class="mx-auto max-w-md">
                @foreach ($contents as $content)
                    <div class="bg-white shadow sm:rounded-lg mt-3">
                        <div class="px-4 py-5 sm:p-6">
                           <div class="flex justify-between">
                            <div>
                                <div class="flex space-x-2">
                                    @if (!$content->user->profile_photo_path)
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ asset('project_images/user1.png') }}" alt="">
                                    @else
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ $content->user->profile_photo_path }}" alt="">
                                    @endif
                                    <div class="block">
                                        <h3 class="text-base font-semibold leading-6 text-gray-900">
                                            {{ $content->user->name }}</h3>
                                        <div class="text-sm text-gray-600 mt-1 sm:mt-0">
                                            {{ $content->created_at->diffForHumans() }}
                                            {{-- {{ $content->created_at->format('F d Y') }} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button wire:click="delete({{ $content->id }})" wire:confirm="Are you sure you want to delete this post?" class="text-xs text-gray-500 hover:text-red-500">
                               @auth
                                    @if ($content->user_id === auth()->user()->id )
                                        X
                                    @endif
                               @endauth
                                {{-- <span :class="{{ $content->user_id === auth()->user()->id ? '' : 'hidden' }}">X</span> --}}
                            </button>
                           </div>
                            <div class="mt-5">
                                <div class="rounded-md bg-gray-50 px-6 py-5 sm:flex sm:items-start sm:justify-between">
                                    <h4 class="sr-only">Visa</h4>
                                    <div class="sm:flex sm:items-start">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check text-green-600" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10.354 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                            <path d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911z"/>
                                          </svg> --}}
                                        {{-- <svg class="h-8 w-auto sm:h-6 sm:flex-shrink-0" viewBox="0 0 36 24" aria-hidden="true">
                      <rect width="36" height="24" fill="#224DBA" rx="4" />
                      <path fill="#fff" d="M10.925 15.673H8.874l-1.538-6c-.073-.276-.228-.52-.456-.635A6.575 6.575 0 005 8.403v-.231h3.304c.456 0 .798.347.855.75l.798 4.328 2.05-5.078h1.994l-3.076 7.5zm4.216 0h-1.937L14.8 8.172h1.937l-1.595 7.5zm4.101-5.422c.057-.404.399-.635.798-.635a3.54 3.54 0 011.88.346l.342-1.615A4.808 4.808 0 0020.496 8c-1.88 0-3.248 1.039-3.248 2.481 0 1.097.969 1.673 1.653 2.02.74.346 1.025.577.968.923 0 .519-.57.75-1.139.75a4.795 4.795 0 01-1.994-.462l-.342 1.616a5.48 5.48 0 002.108.404c2.108.057 3.418-.981 3.418-2.539 0-1.962-2.678-2.077-2.678-2.942zm9.457 5.422L27.16 8.172h-1.652a.858.858 0 00-.798.577l-2.848 6.924h1.994l.398-1.096h2.45l.228 1.096h1.766zm-2.905-5.482l.57 2.827h-1.596l1.026-2.827z" />
                    </svg> --}}
                                        {{-- @if (!$content->user->profile_photo_path)
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                src="{{ asset('project_images/user1.png') }}" alt="">
                                        @else
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                src="{{ $content->user->profile_photo_path }}" alt="">
                                        @endif --}}
                                        <div class="mt-3 sm:ml-4 sm:mt-0">


                                            {{-- <div class="text-sm font-medium text-gray-900"><img class="w-20 h-20 rounded-full object-cover" src="{{ $content->imgage }}" alt=""></div> --}}
                                            @if ($content->image)
                                                <img class="object-cover rounded-md max-h-96 w-auto"
                                                    xclass="xrelative xaspect-[16/9] xsm:aspect-[2/1] xlg:aspect-square xw-24 xw-44 w-56 h-72 xrounded-lg xlg:h-auto xlg:w-56 xlg:shrink-0"
                                                    src="{{ asset($content->image) }}" alt="">
                                            @endif
                                            <div class="mt-3 text-sm font-medium text-gray-900 break-all">
                                                {{ $content->content }}</div>
                                            <div class="mt-1 text-sm text-gray-600 sm:flex sm:items-center">

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right Side Panel Content & Search -->
        <div class="hidden xbg-pink-400">
            {{-- <div class="card-header pb-0 border-0">
                <h5 class="">Search</h5>
            </div> --}}
            <div class="text-gray-500">
                search stuff
                {{-- <livewire:search-posts /> --}}
                {{-- <form action="" method="GET">
                    <input value="{{ request('search', '') }}" name="search" placeholder="Search..."
                        class="form-control w-100" type="text">
                    <button class="btn btn-dark mt-2"></button>
                </form> --}}
            </div>
        </div>

    </div>
</div>
