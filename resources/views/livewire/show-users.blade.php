<div>
    <div class="d-flex justify-content-center">
        <input type="text" class="form-control mb-3 w-75" name="search" placeholder="Search" wire:model="search">
    </div>
    <div class="card">
        <div class="card-body" style="overflow: auto">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <td class="text-center">ID</td>
                        <td class="text-center">Name</td>
                        <td class="text-center">Email</td>
                        <td class="text-center">N° of Recipes</td>
                        <td class="text-center">N° of Comments</td>
                        <td class="text-center">N° of Ratings</td>
                        <td class="text-center">Role</td>
                        <td class="text-center"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $user->id }}</td>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center">{{ $user->recipes->count() }}</td>
                            <td class="text-center">{{ $user->comments->count() }}</td>
                            <td class="text-center">{{ $user->ratings->count() }}</td>
                            <td class="text-center">
                                @livewire('role-input', ['user' => $user], key($user->id))
                            </td>
                            <td >
                                <form class="d-inline m-0" method="POST"
                                    action="{{ route('admin.users.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="" type="submit"><i
                                            class="text-danger bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $users->links() }}
</div>
