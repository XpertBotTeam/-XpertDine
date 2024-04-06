<x-layout>
    <html>

    <body>
        <div class="menu_create_main">

            <div class="main-test-box">
                <h1 style="position: fixed; background-color: yellow;">Test on how your item will be displayed</h1>
                <div class="test-box">
                    <img src="{{ asset('assets/images/default-restaurant-img.png') }}" alt="">
                    <div class="menu-info-test">
                        <h1>Lorem, ipsum.</h1>
                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi.</h3>
                        <p>$5.49</p>
                    </div>
                </div>

                <div class="test-box">
                    <img src="{{ asset('assets/images/default-restaurant-img.png') }}" alt="">
                    <div class="menu-info-test">
                        <h1>Lorem, ipsum.</h1>
                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi.</h3>
                        <p>$5.49</p>
                    </div>
                </div>
                <div class="test-box">
                    <img id="test-img" src="{{ asset('assets/images/default-restaurant-img.png') }}" alt="">
                    <div class="menu-info-test">
                        <h1 id="name">Lorem, ipsum.</h1>
                        <h3 id="des">Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi.</h3>
                        <p id="price">$5.49</p>
                    </div>
                </div>
                <div class="test-box">
                    <img src="{{ asset('assets/images/default-restaurant-img.png') }}" alt="">
                    <div class="menu-info-test">
                        <h1>Lorem, ipsum.</h1>
                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi.</h3>
                        <p>$5.49</p>
                    </div>
                </div>
                <div class="test-box">
                    <img src="{{ asset('assets/images/default-restaurant-img.png') }}" alt="">
                    <div class="menu-info-test">
                        <h1>Lorem, ipsum.</h1>
                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi.</h3>
                        <p>$5.49</p>
                    </div>
                </div>
                <div class="test-box">
                    <img  src="{{ asset('assets/images/default-restaurant-img.png') }}" alt="">
                    <div class="menu-info-test">
                        <h1>Lorem, ipsum.</h1>
                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi.</h3>
                        <p>$5.49</p>
                    </div>
                </div>
                <div class="test-box">
                    <img src="{{ asset('assets/images/default-restaurant-img.png') }}" alt="">
                    <div class="menu-info-test">
                        <h1>Lorem, ipsum.</h1>
                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi.</h3>
                        <p>$5.49</p>
                    </div>
                </div>
            </div>

            <form action="/create/menuCheck" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="m-input-box">
                    <label for="name">Name</label> <br>
                    <input type="text" name="name" value="{{ old('name') }}">
                    <div class="sep"></div>
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="m-input-box">
                    <label for="description">Description</label> <br>
                    <input type="text" name="description" value="{{ old('description') }}">
                    <div class="sep"></div>
                    @error('description')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="m-input-box">
                    <label for="price">Price</label> <br>
                    <input type="number" name="price" value="{{ old('price') }}">
                    <div class="sep"></div>
                    @error('price')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <label for="category">Category</label> <br>
                <select name="category" id="">
                    @unless(count($category) == 0)
                        @foreach($category as $categorys)
                            <option value="{{$categorys->id}}">{{$categorys->name}}</option>
                        @endforeach
            
                        @else 
                            <option>No Listings Found!</option>
                    @endunless
                </select>
                <div class="sep" style="margin-bottom: 1%;"></div>

                <div class="m-input-box">
                    <label for="logo">Logo</label> <br>
                    <input type="file" name="logo" id="logo" accept="image/*" value="{{ old('logo') }}">
                    <div class="sep"></div>
                    @error('logo')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="button-box">
                    <button type="submit">Create</button>
                    <button type="reset">Reset</button>
                </div>

            </form>
        </div>
    </body>

    </html>
</x-layout>

<style>
    body {
        background-color: var(--dark-red);
    }

    select {
        font-weight: 900;
        font-size: 1.4em;
        background: transparent;
        outline: transparent;
        border: 0;
    }

    .test-box,
    .menu_create_main,
    .main-test-box {
        display: flex;
    }

    .menu_create_main {
        height: 80vh;
        width: 90%;
        overflow: hidden;
        margin: auto;
        justify-content: center;
        margin-top: 5%;
        border-radius: 20px;
    }

    .main-test-box {
        width: 90%;
        flex-direction: column;
        overflow-y: scroll
    }

    .test-box {
        background-color: var(--CreamyWhite);
        width: 100%;
        padding: 3%;

    }

    .test-box img {
        width: 20%;
        height: 15vh;
    }

    .menu-info-test {
        margin-left: 2.5%;
    }

    .menu-info-test h1 {
        font-weight: 900;
        margin-bottom: 2%;
    }

    .menu-info-test p {
        margin-top: 2%;
        font-size: 1.2em;
    }

    form {
        background-color: #E0E0E0;
        margin-left: 0;
        width: 90%;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const nameInput = document.querySelector("input[name='name']");
        const descriptionInput = document.querySelector("input[name='description']");
        const priceInput = document.querySelector("input[name='price']");
        const imageInput = document.getElementById("logo");
        const testImage = document.getElementById("test-img");

        nameInput.addEventListener("input", updateTestBoxText);
        descriptionInput.addEventListener("input", updateTestBoxText);
        priceInput.addEventListener("input", updateTestBoxText);
        imageInput.addEventListener("change", updateTestBoxImage);

        function updateTestBoxText() {
            const testName = document.getElementById("name");
            const testDescription = document.getElementById("des");
            const testPrice = document.getElementById("price");
            testName.textContent = nameInput.value;
            testDescription.textContent = descriptionInput.value;
            testPrice.textContent = "$" + priceInput.value;
        }

        function updateTestBoxImage() {
            const file = imageInput.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                testImage.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    });
</script>
