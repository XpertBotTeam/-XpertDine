<x-layout>
    <div class="body">
        <div class="form-main-container">
            <div class="sectionform">
                <h1>Add Your Restaurant</h1>
                <p>To use all features <br>of the application</p>
            </div>
            <form action="/create/restaurantCheck" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-box">
                    <label for="name">Name</label> <br>
                    <input type="text" name="name" value="{{ old('name') }}">
                    <div class="sep"></div>
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-box">
                    <label for="location">Location</label> <br>
                    <input type="text" name="location" value="{{ old('location') }}">
                    <div class="sep"></div>
                    @error('location')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-box">
                    <label for="description">Description</label> <br>
                    <input type="text" name="description" value="{{ old('description') }}">
                    <div class="sep"></div>
                    @error('description')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-box">
                    <label for="phoneNumber">Restaurant PhoneNumber</label> <br>
                    <input type="number" name="phoneNumber" value="{{ old('phoneNumber') }}">
                    <div class="sep"></div>
                    @error('phoneNumber')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="m-input-box">
                    <label for="logo">Logo</label> <br>
                    <input type="file" name="logo" id="logo" accept="image/*" value="{{ old('logo') }}">
                    <div class="sep"></div>
                    @error('logo')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <label for="category">Category</label> <br>
                <select name="category" id="">
                    @unless (count($category) == 0)
                        @foreach ($category as $categorys)
                            <option value="{{ $categorys->id }}">{{ $categorys->name }}</option>
                        @endforeach
                    @else
                        <option>No category Found!</option>
                    @endunless
                </select>
                <div class="sep" style="margin-bottom: 1%;"></div>

                <div class="input-box">
                    <label for="openTime">openTime</label> <br>
                    <input type="time" name="openTime" value="{{ old('openTime') }}">
                    <div class="sep"></div>
                    @error('openTime')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-box">
                    <label for="closeTime">closeTime</label> <br>
                    <input type="time" name="closeTime" value="{{ old('closeTime') }}">
                    <div class="sep"></div>
                    @error('closeTime')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="button-box">
                    <button type="submit">Add Restaurant</button>
                    <button type="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
