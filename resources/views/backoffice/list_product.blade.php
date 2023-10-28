@extends('layouts.main')
@section('body')
@csrf
<div class="container ml-3">
    <a href="{{ route('product.create') }}" class="btn btn-success">Ajouter un produit</a>
</div>

<div class="container pt-5">
    <div class="row mb-3">
        <div class="col-12">
            <form action="{{ route('list_product') }}" method="GET">
                <div class="form-group">
                    <label for="categorie">Filtrer par catégorie :</label>
                    <select name="categorie" id="categorie" class="form-control">
                        <option value="all" {{ $selectedCategory === 'all' ? 'selected' : '' }}>Tous</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                                {{ $category->nom_categorie }}
                            </option>
                        @endforeach
                    </select> 
                </div>
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="data_table">
                <table id="example" class="table pt-5 table-striped table-bordered">
                    <thead class="table color1">
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><img src="{{ asset($product->image_product) }}" alt="{{ $product->nom_product }}" width="50"></td>
                                <td>{{ $product->nom_product }}</td>
                                <td>{{ $product->prix_product }}</td>
                                <td class="align-middle">  
                                    <form action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0" style="background: none; border: none; cursor: pointer;">
                                            <ion-icon name="trash-outline" style="font-size: 30px; color: red;"></ion-icon>
                                        </button>
                                    </form>
                                    <a href="{{ route('product.edit', $product->id) }}" class="mr-2">
                                        <ion-icon name="eyedrop-outline" style="font-size: 30px; color:green;"></ion-icon>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#productModal{{ $product->id }}">
                                        <ion-icon name="information-circle-outline" style="font-size: 30px; color: primary;"></ion-icon>
                                    </a>
                                </td>

                            </tr>
                            @include('backoffice.detail_produit') 
                     @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
