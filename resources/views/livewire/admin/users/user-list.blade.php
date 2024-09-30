<div>
    <div class="table-responsive">
        <table class="table text-center">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone Number</td>
                    <td>Role</td>
                    <td>Action</td>
                </tr>
            </thead>
            @if ($users->count() > 0)
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->index + $users->firstItem() }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @if ($user->phone_number == null)
                            <td>-</td>
                        @else
                            <td>{{ $user->phone_number }}</td>
                        @endif
                        @if ($user->roles->count() > 0)
                            @foreach ($user->roles as $item)
                                <td>{{ $item->name }}</td>
                            @endforeach
                        @else
                            <td>-</td>
                        @endif
                        <td>
                            <button class="btn btn-primary btn-sm" wire:click="loadUser({{ $user->id }})"
                                data-bs-toggle="modal" data-bs-target="#editUserModal"><i
                                    class="bi bi-pencil-square"></i></button>
                            <button wire:click="deleteUser({{ $user->id }})" wire:confirm
                                class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">No Data</td>
                </tr>
            @endif
        </table>
    </div>
    <div class="row mt-3">
        <div class="col">
            {{ $users->links() }}
        </div>
    </div>
    <livewire:admin.users.modal-edit-users />
</div>

@script
    <script>
        $wire.on('close-modal', () => {
            var modal = new bootstrap.Modal(document.getElementById('editUserModal'));
            modal.style.display = 'hidden';
        });
    </script>
@endscript

