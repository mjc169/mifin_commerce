<template>
  <div class="product">
    <div class="card">
      <div class="card-header">
        <h4 class="text-success">My Cart 
          <button class="btn btn-danger float-end mx-2">Empty Cart</button>
          <button class="btn btn-primary float-end mx-2">Proceed to Checkout</button>
          
        </h4>
      </div>
      <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'myCart',
    data() {
      return {
        cart: []
      }
    },
    mounted(){
      console.log("I am here cart");
    }
  }
</script>