@extends('layouts.auth')

@section('content')
    <!-- Page Content -->
    <div class="page-content page-auth" id="register">
        <div class="section-store-auth" data-aos="fade-up">
          <div class="container">
            <div class="row align-items-center justify-content-center row-login">
              <div class="col-lg-4">
                <h2>
                  Memulai untuk jual beli <br/>
                  dengan cara terbaru
                </h2>
                <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group">
                    <label>Full Name</label>
                      <input v-model="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                  </div>
                  <div class="form-group">
                    <label>Email address</label>
                    <input title="email" 
                    id="email" 
                    v-model="email"
                    @change="checkForEmailAvailability()"
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror"
                    :class="{ 'is-invalid': this.email_unavailable}"
                    name="email" value="{{ old('email') }}" 
                    required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input id="password" 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    name="password" 
                    required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" 
                    type="password" 
                    class="form-control @error('password_confirm') is-invalid @enderror" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password">

                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  
                  <div class="form-group">
                    <label class="mt-2">Store</label>
                    <p class="text-muted">Apakah anda ingin membuka toko?</p>
                    <div
                      class="custom-control custom-radio custom-control-inline"
                    >
                      <input
                        title="radio1"
                        type="radio"
                        class="custom-control-input form-check-input inline-flex"
                        name="is_store_open"
                        id="openStoreTrue"
                        v-model="is_store_open"
                        :value="true"
                      />
                      <label for="openStoreTrue" class="custom-control-label"
                        >Iya, Boleh</label
                      >
                    </div>
                    <div
                      class="custom-control custom-radio custom-control-inline"
                    >
                      <input
                        title="radio2"
                        type="radio"
                        class="custom-control-input form-check-input inline-flex"
                        name="is_store_open"
                        id="openStoreFalse"
                        v-model="is_store_open"
                        :value="false"
                      />
                      <label for="openStoreFalse" class="custom-control-label"
                        >Tidak, Makasih</label
                      >
                    </div>
                    <div class="form-group" v-if="is_store_open">
                      <label>Nama Toko</label>
                      <input
                        title="nama Toko"
                        type="text"
                        name="store_name"
                        autocomplete
                        class="form-control"
                        aria-describedby="namatoko"
                        autofocus
                        required
                        v-model="store_name"
                      />
                      
                      @error('store_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="form-group" v-if="is_store_open">
                      <label>kategori</label>
                      <select
                        name="categories_id"
                        class="form-control"
                        title="category"
                      >
                        <option value="" disabled>Select Category</option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mt-4" :disabled="this.email_unavailable">
                      Sign Up Now
                    </button>
                    <a
                      class="btn btn-signup w-100 mt-2"
                      href="{{ route('login') }}">
                      Back To Sign In
                    </a>
                  </div>
                </form>
                <template>
                </template>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script>
  let register = new Vue({
    el: "#register",
    mounted() {
      
      AOS.init();
      Vue.use(Toasted);
      $toasted = Toasted;
    },
    methods: {
  checkForEmailAvailability: function() {
    let self = this; // Menyimpan konteks this

    axios.get('{{ route('api-register-check') }}', {
      params: {
        email: this.email
      }
    })
    .then(function(response) {
      if(response.data === 'Available') {
        self.$toasted.show(
          "Your email is available! Please proceed to the next step.",
          {
            position: "top-center",
            className: "rounded",
            duration: 2000
          }
        );
        self.email_unavailable = false;
      } else {
        self.$toasted.show(
          "Sorry, it seems that the email is already registered in our system.",
          {
            position: "top-center",
            className: "rounded",
            duration: 2000
          }
        );
        self.email_unavailable = true;
      }
      console.log(response);
    })
    .catch(function(error) {
      console.error('Error:', error);
    });
  }
},
    data() {
      return {
      name: "your name",
      email: "example@email.com",
      is_store_open: false,
      store_name: "",
      email_unavailable : false
      }
    },
  });
</script>
@endpush