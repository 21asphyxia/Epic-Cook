@extends('layouts.admin')

@section('content')
    <h1>Recipes</h1>
    {{-- success --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <button id="create-button" class="btn btn-primary mb-3 text-end" >Add new ingredient</button>
    <div class="card">
        <div class="card-body" style="overflow: auto">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <td class="text-center">ID</td>
                        <td class="text-center">Name</td>
                        <td class="text-center">N° of recipes included in</td>
                        <td class="text-center"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredients as $ingredient)
                        <tr>
                            <td class="text-center">{{ $ingredient->id }}</td>
                            <td class="text-center">{{ $ingredient->name }}</td>
                            <td class="text-center">{{ $ingredient->recipes->count() }}</td>
                            <td class="actionsIcons d-flex justify-content-end align-items-center">
                                <button class="me-3" onclick="editCategory({{ $ingredient->id }})"><i
                                        class="bi fs-6 text-primary bi-pencil-square"></i></button>
                                <form class="d-inline m-0" method="POST"
                                    action="{{ route('admin.ingredients.destroy', $ingredient) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="" type="submit"><i class="text-danger bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    {{ $ingredients->links() }}

    <form class="modal fade" id="form" tabindex="-1" action="{{ route('admin.ingredients.store') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header mb-3">
                    <h5 id="modalTitle" class="modal-title">Add Ingredient</h5>
                    <button type="button" id="close-button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="ingredientId">
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" id="ingredientName"
                            placeholder="Ingredient Name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel-button">Cancel</button>
                    <button type="submit" name="save" id="save-button" class="btn btn-primary">Save</button>
                    <button type="submit" name="update" class="btn btn-primary" id="update-button">Update</button>
                </div>

            </div>
        </div>
    </form>
@endsection

@section('additionalJS')
    <script>
        document.getElementById("create-button").addEventListener("click", function () {
            document.getElementById("modalTitle").innerHTML = "Add Category";
            document.getElementById("form").action = "{{ route('admin.ingredients.store') }}";
            if(document.querySelector('#method'))      document.querySelector('#method').remove();
            document.getElementById("ingredientId").value = "";
            document.getElementById("ingredientName").value = "";
            document.getElementById("update-button").classList.add("d-none");
            document.getElementById("save-button").classList.remove("d-none");
            
            $('#form').modal('show');
        });

            function editCategory(id) {
                document.getElementById("modalTitle").innerHTML = "Edit Category";

                document.getElementById("update-button").classList.remove("d-none");
                document.getElementById("save-button").classList.add("d-none");

                document.getElementById("form").action = "{{ route('admin.ingredients.update', '') }}" + "/" + id; 
                document.querySelector('.modal-body').innerHTML += `<input id="method" type="hidden" name="_method" value="PUT">`;

                    $('#form').modal('show');

                $.ajax({
                    
                    url: '/dashboard/ingredients/' + id,
                    type: 'GET',
                    
                    success: function(result) {
                        let ingredient = result;
                        document.getElementById("ingredientId").value = ingredient.id;
                        document.getElementById("ingredientName").value = ingredient.name;
                    },
                    fail: function(result) {
                        console.log(result);
                    }
                });
            }
    </script>
@endsection
