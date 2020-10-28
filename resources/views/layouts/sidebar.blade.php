<div
    class="hidden md:block fixed sidebar w-64 z-30 inset-y-0 left-0 transition duration-300 transform bg-gray-900 overflow-y-auto">
    <div>
        <div class="flex items-center justify-center mt-8 sidebar--logo">
            <div class="flex items-center">
                <span class="text-white text-2xl mx-2 font-semibold">Белая полоса</span>
            </div>
        </div>

        <nav class="mt-10 sidebar--nav">
            @can('manage users')
                <a class="flex items-center mt-4 py-2 px-6 {{ Request::is('users') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
                   href="{{route('users')}}">
                    <svg class="h-6 w-6 fill-current" viewBox="0 0 478.024 478.024">
                        <path
                            d="M411.703 73.561A238.64 238.64 0 00238.943.011C107.145-.155.166 106.554 0 238.353a238.647 238.647 0 0073.55 172.623c.137.136.188.341.324.461 1.382 1.331 2.884 2.458 4.284 3.738 3.84 3.413 7.68 6.946 11.725 10.24a163.172 163.172 0 006.639 4.983c3.823 2.85 7.646 5.7 11.639 8.329 2.714 1.707 5.513 3.413 8.294 5.12 3.686 2.219 7.356 4.454 11.162 6.485 3.226 1.707 6.519 3.174 9.796 4.727 3.584 1.707 7.117 3.413 10.786 4.949 3.669 1.536 7.356 2.731 11.076 4.062s6.929 2.56 10.496 3.652c4.028 1.212 8.158 2.15 12.254 3.157 3.413.836 6.724 1.792 10.24 2.475 4.71.939 9.489 1.536 14.268 2.185 2.953.41 5.837.99 8.823 1.28 7.817.768 15.701 1.195 23.654 1.195s15.838-.427 23.654-1.195c2.987-.29 5.871-.87 8.823-1.28 4.779-.649 9.557-1.246 14.268-2.185 3.413-.683 6.827-1.707 10.24-2.475 4.096-1.007 8.226-1.946 12.254-3.157 3.567-1.092 7.014-2.423 10.496-3.652s7.441-2.56 11.076-4.062 7.202-3.26 10.786-4.949c3.277-1.553 6.571-3.021 9.796-4.727 3.806-2.031 7.475-4.267 11.162-6.485 2.782-1.707 5.581-3.26 8.294-5.12 3.994-2.628 7.817-5.478 11.639-8.329 2.219-1.707 4.471-3.243 6.639-4.983 4.045-3.243 7.885-6.69 11.725-10.24 1.399-1.28 2.901-2.406 4.284-3.738.136-.119.188-.324.324-.461 95.174-91.178 98.411-242.244 7.233-337.415zm-38.359 319.546c-3.106 2.731-6.315 5.325-9.557 7.834-1.911 1.468-3.823 2.918-5.786 4.318a189.792 189.792 0 01-9.421 6.383 211.443 211.443 0 01-7.083 4.318 882.43 882.43 0 01-9.148 5.12c-2.731 1.399-5.513 2.714-8.311 4.011s-5.888 2.679-8.909 3.891c-3.021 1.212-6.229 2.355-9.387 3.413-2.884.99-5.768 2.014-8.687 2.884-3.413 1.024-6.98 1.86-10.513 2.714-2.765.648-5.495 1.382-8.294 1.929-4.045.785-8.175 1.331-12.322 1.894-2.355.307-4.693.734-7.066.973-6.554.631-13.193 1.007-19.9 1.007s-13.346-.375-19.9-1.007c-2.372-.239-4.71-.666-7.066-.973-4.147-.563-8.277-1.109-12.322-1.894-2.799-.546-5.53-1.28-8.294-1.929-3.533-.853-7.049-1.707-10.513-2.714-2.918-.87-5.803-1.894-8.687-2.884-3.157-1.092-6.315-2.202-9.387-3.413-3.072-1.212-5.973-2.543-8.909-3.891s-5.581-2.611-8.311-4.011a155.774 155.774 0 01-9.148-5.12 210.796 210.796 0 01-7.083-4.318 190.261 190.261 0 01-9.421-6.383c-1.963-1.399-3.874-2.85-5.786-4.318a207.479 207.479 0 01-9.557-7.834c-.751-.563-1.434-1.28-2.167-1.929.763-58.057 38.06-109.321 93.065-127.915a101.192 101.192 0 0086.938 0c55.004 18.594 92.301 69.857 93.065 127.915-.717.649-1.4 1.298-2.133 1.929zM179.43 136.849c18.479-32.864 60.1-44.525 92.964-26.046s44.525 60.1 26.046 92.964a68.267 68.267 0 01-26.046 26.046c-.085 0-.188 0-.29.102a72.308 72.308 0 01-14.268 6.042c-.887.256-1.707.597-2.645.819-1.707.444-3.499.751-5.257 1.058a69.13 69.13 0 01-10.018 1.007h-1.946a69.13 69.13 0 01-10.018-1.007c-1.707-.307-3.516-.614-5.256-1.058-.905-.222-1.707-.563-2.645-.819a72.249 72.249 0 01-14.268-6.042l-.307-.102c-32.864-18.479-44.525-60.1-26.046-92.964zm226.323 220.487a171.517 171.517 0 00-91.375-117.64c38.245-41.661 35.475-106.438-6.186-144.683-41.661-38.245-106.438-35.475-144.683 6.186-35.954 39.166-35.954 99.332 0 138.497a171.52 171.52 0 00-91.375 117.64C6.69 265.153 28.366 137.371 120.549 71.927s219.965-43.768 285.409 48.415a204.707 204.707 0 0137.786 118.602 203.471 203.471 0 01-37.991 118.392z"/>
                    </svg>

                    <span class="mr-3 ml-5">Сотрудники</span>
                </a>
            @endcan

            <a class="flex items-center mt-4 py-2 px-6 {{ Request::is('worksheets*') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{route('worksheets.index')}}">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/>
                </svg>

                <span class="mr-3 ml-5">Анкеты</span>
            </a>

            {{-- TODO: Permission to edit banks --}}
            @can('manage heads')
                <a class="flex items-center mt-4 py-2 px-6 {{ Request::is('banks*') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
                   href="{{route('banks.index')}}">
                    <svg class="h-6 w-6 fill-current" viewBox="0 0 512 512">
                        <path
                            d="M496 191.992c8.832 0 16-7.168 16-16v-32c0-5.92-3.264-11.328-8.48-14.112l-240-128a16.105 16.105 0 00-15.072 0l-240 128A16.02 16.02 0 000 143.992v32c0 8.832 7.168 16 16 16h16v224c-17.632 0-32 14.336-32 32v48c0 8.832 7.168 16 16 16h480c8.832 0 16-7.168 16-16v-48c0-17.664-14.368-32-32-32v-224h16zm-16 288H32v-32h448v32zm-416-64v-224h32v224H64zm64 0v-224h256v224H128zm288 0v-224h32v224h-32zm-384-256v-6.4L256 34.136l224 119.456v6.4H32z"/>
                        <path
                            d="M256 287.992c-8.832 0-16-7.2-16-16s7.168-16 16-16h32c8.832 0 16-7.168 16-16s-7.168-16-16-16h-16v-16c0-8.832-7.168-16-16-16s-16 7.168-16 16v18.944c-18.592 6.624-32 24.224-32 45.056 0 26.464 21.536 48 48 48 8.832 0 16 7.2 16 16s-7.168 16-16 16h-32c-8.832 0-16 7.168-16 16s7.168 16 16 16h16v16c0 8.832 7.168 16 16 16s16-7.168 16-16v-18.944c18.592-6.624 32-24.224 32-45.056 0-26.464-21.536-48-48-48z"/>
                    </svg>

                    <span class="mr-3 ml-5">Банки</span>
                </a>
            @endcan
        </nav>
    </div>
</div>
