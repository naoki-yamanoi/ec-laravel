<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      期限切れオーナー一覧
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <section class="text-gray-600 body-font">
            <div class="container px-5 mx-auto">
              {{-- フラッシュメッセージ --}}
              <x-flash-message status="session('status')" />
              <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                  <thead>
                    <tr>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl text-center">名前</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 text-center">メールアドレス</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 text-center">期限が切れた日</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br text-center">完全に削除</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($expiredOwners as $expiredOwner)
                      <tr>
                        <td class="px-4 py-3 text-center">{{ $expiredOwner->name }}</td>
                        <td class="px-4 py-3 text-center">{{ $expiredOwner->email }}</td>
                        <td class="px-4 py-3 text-center">{{ $expiredOwner->deleted_at->diffForHumans() }}</td>
                        <form id="delete_{{ $expiredOwner->id }}" method="POST" action="{{ route('admin.expired-owners.destroy', ['expiredOwner' => $expiredOwner->id]) }}">
                          @method('delete')
                          @csrf
                          <td class="px-4 py-3 text-center">
                            <button type="button" data-id="{{ $expiredOwner->id }}" onclick="deletePost(this)" class="text-white bg-red-500 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded">完全に削除</button>
                          </td>
                        </form>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>

  <script>
    function deletePost(e) {
      'use strict';
      if (confirm('本当に削除してもいいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
      }
    }
  </script>

</x-app-layout>
