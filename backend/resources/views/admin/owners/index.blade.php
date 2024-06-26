<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      オーナー一覧
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
              <div class="lg:w-2/3 mx-auto flex justify-end mb-4">
                <button onclick="location.href='{{ route('admin.owners.create') }}'" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録</button>
              </div>
              <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                  <thead>
                    <tr>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl text-center">名前</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 text-center">メールアドレス</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 text-center">作成日</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 text-center">編集</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl text-center">削除</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($owners as $owner)
                      <tr>
                        <td class="px-4 py-3 text-center">{{ $owner->name }}</td>
                        <td class="px-4 py-3 text-center">{{ $owner->email }}</td>
                        <td class="px-4 py-3 text-center">{{ $owner->created_at->diffForHumans() }}</td>
                        <td class="px-4 py-3 text-center">
                          <button onclick="location.href='{{ route('admin.owners.edit', ['owner' => $owner->id]) }}'" class="text-white bg-green-500 border-0 py-2 px-4 focus:outline-none hover:bg-green-600 rounded">編集</button>
                        </td>
                        <form id="delete_{{ $owner->id }}" method="POST" action="{{ route('admin.owners.destroy', ['owner' => $owner->id]) }}">
                          @method('delete')
                          @csrf
                          <td class="px-4 py-3 text-center">
                            <button type="button" data-id="{{ $owner->id }}" onclick="deletePost(this)" class="text-white bg-red-500 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded">削除</button>
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
