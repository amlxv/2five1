@extends('layouts.settings')

@section('title', 'My Purchases')
@section('setting-title', 'My Purchases')
@section('setting-description', 'View your purchases')

@section('setting-content')

    <div class="table-responsive">
        <table class="table">
            <thead class="text-theme-darker">
                <th>
                    No.
                </th>
                <th>
                    Product Name
                </th>
                <th>
                    Amount
                </th>
                <th>
                    Status
                </th>
                <th>
                    Actions
                </th>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ Str::limit($purchase->product_name, 20) }}
                        </td>
                        <td class="text-nowrap">
                            RM {{ $purchase->total_price }}
                        </td>
                        <td>
                            @if ($purchase->status == 'pending')
                                <span class="badge bg-primary text-capitalize">
                                    {{ $purchase->status }}
                                </span>
                            @elseif ($purchase->status == 'success')
                                <span class="badge bg-success text-capitalize">
                                    {{ $purchase->status }}
                                </span>
                            @else
                                <span class="badge bg-danger text-capitalize">
                                    {{ $purchase->status }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <button onclick="getDetails({{ $purchase->id }})" type="button" class="btn btn-theme py-1"
                                data-bs-toggle="modal" data-bs-target="#detailsModal">
                                Details
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script defer>
        const detailsModal = document.querySelector('#detailsModal');

        function getDetails(id) {
            axios({
                method: 'get',
                url: '/purchases/' + id,
            }, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(function(response) {
                console.log(response.data)
                const {
                    product_name,
                    total_price,
                    status,
                    when,
                    transaction_id,
                    order_id,
                } = response.data;

                detailsModal.querySelector('.modal-body').innerHTML = `
                   
                        
                            <div class="form-group mb-2">
                                <label class="form-label" for="product_name">Product Name</label>
                                <input type="text" class="form-control" value="${product_name}" disabled>
                            </div>
                      
                            <div class="form-group mb-2">
                                <label class="form-label" for="total_price">Total Price</label>
                                <input type="text" class="form-control" value="RM ${total_price}" disabled>
                            </div>
                        
                            <div class="form-group mb-2">
                                <label class="form-label" for="updated_at">Order ID</label>
                                <input type="text" class="form-control" value="${order_id}" disabled>
                            </div>

                            <div class="form-group mb-2">
                                <label class="form-label" for="updated_at">Transaction ID</label>
                                <input type="text" class="form-control" value="${transaction_id ?? 'Not Available'}" disabled>
                            </div>

                            <div class="form-group mb-2">
                                <label class="form-label" for="status">Status</label>
                                <input type="text" class="form-control text-capitalize" value="${status}" disabled>
                            </div>
                       
                            <div class="form-group mb-2">
                                <label class="form-label" for="created_at">Created At</label>
                                <input type="text" class="form-control" value="${when}" disabled>
                            </div>
        
                `;

            }).catch(function(error) {
                console.log(error)
                detailsModal.querySelector('.modal-body').innerHTML = error;
            })
        }
    </script>

@endsection
