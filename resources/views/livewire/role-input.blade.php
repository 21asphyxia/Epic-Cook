<div>
    <select class="form-select min-width-100" name="role" id="role" wire:model="selectedRole">
        @foreach ($roles as $role)
            <option value="{{ $role->name }}">{{ $role->name }}</option>
        @endforeach
    </select>
</div>
