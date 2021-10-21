

@extends('layouts.app')

@section('content')
<div class="container">
  <br>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Todo Details</h2>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <a href="{{ route('todo.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <br><br>
            <div class="todo-title">
                <strong>Title: </strong> {{ $todo->title }}
            </div>
            <br>
            <div class="todo-description">
                <strong>Description: </strong> {{ $todo->description }}
            </div>
            <br>
            <div class="todo-description">
                <strong>Status: </strong> {{ $todo->status }}
            </div>

        </div>
    </div>

    <br>
    <hr>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Payment Details</h2>
            </div>
        </div>
        <form>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email">
              </div>
              <div class="form-group col-md-6">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" placeholder="Amount">
              </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="firstName">First Name</label>
                  <input type="text" class="form-control" id="firstName" placeholder="First Name">
                </div>
                <div class="form-group col-md-6">
                  <label for="lastName">Last Name</label>
                  <input type="text" class="form-control" id="lastName" placeholder="Last Name">
                </div>
              </div>

          </form>
    </div>

    <div class="row justify-content-center">
        <div class="todo-description">
            <button onclick="PayUp()" type="button" class="btn btn-primary" >Pay For Task</button>
            <script src="https://js.paystack.co/v2/inline.js"></script>
            <script>
                function PayUp() {
                    var email = document.getElementById("email").value;
                    var amount = document.getElementById("amount").value;
                    var name = document.getElementById("firstName").value;
                    const paystack = new PaystackPop();
                    paystack.newTransaction({
                        key: 'pk_test_6c4c1910cc7c3bec582a1f61286934b35438b8ea',
                        email: email,
                        amount: amount*100,
                        ref: 'VPAY_' + Math.floor((Math.random() * 1000000000) + 1),
                        onSuccess: (transaction) => {
                            // Payment complete! Reference: transaction.reference
                            var reference_id = 'transaction.reference'
                            reference_id = transaction.reference
                            // var url = " {{ route('verify',':id') }} " ;
                            // url = url.replace(':id', amount)
                            let message = 'Payment complete! Reference: ' + reference_id;

                            // window.location = url;
                            $.ajax({
                                url: "/verify",
                                type:"POST",
                                data:{
                                name:name,
                                email:email,
                                amount:amount,
                                message:message,
                                reference: reference_id,
                                _token: "{{ csrf_token() }}"
                                },
                                success:function(response){
                                    url = " {{ route('todo.index') }} "
                                    window.location = url;

                                },

                            });


                        },
                        onCancel: () => {
                            // user closed popup
                            alert('You are about to exit payment');
                        }
                    });
                }
            </script>
        </div>

    </div>
</div>
@endsection


