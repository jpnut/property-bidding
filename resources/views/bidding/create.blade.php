@extends('layout')

@section('title', 'Bidding Form')

@section('content')
    <br>
    <div class="container">
        <div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" id="bidding-form" novalidate>
                @csrf
                <div id="properties-container">
                </div>
                <a href="javascript:" id="add-new-property">Add new Property</a>
                <hr>
                <div id="buyers-container">
                </div>
                <a href="javascript:" id="add-new-buyer">Add new Buyer</a>
                <hr>
                <div class="solicitor">
                    <h5>Solicitor</h5>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Company</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="solicitor[company]"
                                       placeholder="Company">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="solicitor[first_name]" placeholder="First Name"
                                   required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Surname</label>
                            <input type="text" class="form-control" name="solicitor[last_name]" placeholder="Surname"
                                   required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-9 mb-3">
                            <label>Address</label>
                            <textarea class="form-control" name="solicitor[address]" placeholder="Address"
                                      required></textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Postcode</label>
                            <input type="text" class="form-control" name="solicitor[postcode]" placeholder="Postcode"
                                   required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Telephone</label>
                            <div class="input-group">
                                <input type="tel" class="form-control" name="solicitor[telephone]"
                                       placeholder="Telephone">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Mobile</label>
                            <input type="tel" class="form-control" name="solicitor[mobile]" placeholder="Mobile">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="solicitor[email]" placeholder="Email"
                                   required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let buyers = 0;

        function addNewBuyer() {
            let template = `
                <div class="buyer">
                    <h5>Buyer ${buyers + 1}</h5>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Company</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="buyers[${buyers}][company]"
                                       placeholder="Company">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="buyers[${buyers}][first_name]" placeholder="First Name"
                                   required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Surname</label>
                            <input type="text" class="form-control" name="buyers[${buyers}][last_name]" placeholder="Surname"
                                   required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-9 mb-3">
                            <label>Address</label>
                            <textarea class="form-control" name="buyers[${buyers}][address]" placeholder="Address" required></textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Postcode</label>
                            <input type="text" class="form-control" name="buyers[${buyers}][postcode]" placeholder="Postcode"
                                   required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Telephone</label>
                            <div class="input-group">
                                <input type="tel" class="form-control" name="buyers[${buyers}][telephone]" placeholder="Telephone">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Mobile</label>
                            <input type="tel" class="form-control" name="buyers[${buyers}][mobile]" placeholder="Mobile">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="buyers[${buyers}][email]" placeholder="Email"
                                   required>
                        </div>
                    </div>
                </div>`
            ;

            let container = document.getElementById('buyers-container');
            let div = document.createElement('div');
            div.innerHTML = template;
            container.appendChild(div);

            buyers++;
        }

        document.getElementById('add-new-buyer').onclick = addNewBuyer;

        const available_properties = @json($properties);

        const options = available_properties.map(function (property) {
            return `<option value="${property.id}">${property.address}</option>`;
        }).join('');

        let properties = 0;

        function addNewProperty() {
            let template = `
                <div class="form-group">
                    <label">Property ${properties + 1}</label>
                    <select name="properties[${properties}][id]" class="form-control">
                        ${options}
                    </select>
                </div>`
            ;

            let container = document.getElementById('properties-container');
            let div = document.createElement('div');
            div.innerHTML = template;
            container.appendChild(div);

            properties++;
        }

        document.getElementById('add-new-property').onclick = addNewProperty;

        window.onload = function () {
            addNewProperty();
            addNewBuyer();
        };
    </script>
@endsection
