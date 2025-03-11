{{--
  Template Name: Global Style Guide
--}}


@extends('page')

@section('content')
    <div class="container pb-10">
        <h2 class="mt-10">Colours</h2>
        <div class="box-holder">
        <div class="color-box bg-theme--primary-900">Primary 900</div>
        <div class="color-box bg-theme--primary-800">Primary 800</div>
        <div class="color-box bg-theme--primary-700">Primary 700</div>
        <div class="color-box bg-theme--primary-600">Primary 600</div>
        <div class="color-box bg-theme--primary-500">Primary 500</div>
        <div class="color-box bg-theme--primary-400">Primary 400</div>
        <div class="color-box bg-theme--primary-300">Primary 300</div>
        <div class="color-box bg-theme--primary-200">Primary 200</div>
        <div class="color-box bg-theme--primary-100">Primary 100</div>
        <div class="color-box bg-theme--primary-50">Primary 50</div>
    
        <div class="color-box bg-theme--secondary-900">Secondary 900</div>
        <div class="color-box bg-theme--secondary-800">Secondary 800</div>
        <div class="color-box bg-theme--secondary-700">Secondary 700</div>
        <div class="color-box bg-theme--secondary-600">Secondary 600</div>
        <div class="color-box bg-theme--secondary-500">Secondary 500</div>
        <div class="color-box bg-theme--secondary-400">Secondary 400</div>
        <div class="color-box bg-theme--secondary-300">Secondary 300</div>
        <div class="color-box bg-theme--secondary-200">Secondary 200</div>
        <div class="color-box bg-theme--secondary-100">Secondary 100</div>
        <div class="color-box bg-theme--secondary-50">Secondary 50</div>

        <div class="color-box bg-theme--tertiary-900">Tertiary 900</div>
        <div class="color-box bg-theme--tertiary-800">Tertiary 800</div>
        <div class="color-box bg-theme--tertiary-700">Tertiary 700</div>
        <div class="color-box bg-theme--tertiary-600">Tertiary 600</div>
        <div class="color-box bg-theme--tertiary-500">Tertiary 500</div>
        <div class="color-box bg-theme--tertiary-400">Tertiary 400</div>
        <div class="color-box bg-theme--tertiary-300">Tertiary 300</div>
        <div class="color-box bg-theme--tertiary-200">Tertiary 200</div>
        <div class="color-box bg-theme--tertiary-100">Tertiary 100</div>
        <div class="color-box bg-theme--tertiary-50">Tertiary 50</div>
    
        <div class="color-box bg-theme--quaternary-900">Quaternary 900</div>
        <div class="color-box bg-theme--quaternary-800">Quaternary 800</div>
        <div class="color-box bg-theme--quaternary-700">Quaternary 700</div>
        <div class="color-box bg-theme--quaternary-600">Quaternary 600</div>
        <div class="color-box bg-theme--quaternary-500">Quaternary 500</div>
        <div class="color-box bg-theme--quaternary-400">Quaternary 400</div>
        <div class="color-box bg-theme--quaternary-300">Quaternary 300</div>
        <div class="color-box bg-theme--quaternary-200">Quaternary 200</div>
        <div class="color-box bg-theme--quaternary-100">Quaternary 100</div>
        <div class="color-box bg-theme--quaternary-50">Quaternary 50</div>
    
        <div class="color-box bg-theme--link">Link</div>
        <div class="color-box bg-theme--success">Success</div>
        <div class="color-box bg-theme--danger">Danger</div>
</div>


        <div class="mt-10">
            <h1>Heading 1</h1>
            <h1><span class="light">Light</span> <span>Regular</span> <span class="medium">Medium</span> <span
                    class="bold">Bold</span></h1>
                    <hr style="margin-bottom: 10px">
            <h2>Heading 2 Regular</h2>
            <h2><span class="light">Light</span> <span>Regular</span> <span class="medium">Medium</span> <span
                    class="bold">Bold</span></h2>
                    <hr style="margin-bottom: 10px">
            <h3>Heading 3 Regular</h3>
            <h3><span class="light">Light</span> <span>Regular</span> <span class="medium">Medium</span> <span
                    class="bold">Bold</span></h3>
                    <hr style="margin-bottom: 10px">
            <h4>Heading 4 Regular</h4>
            <h4><span class="light">Light</span> <span>Regular</span> <span class="medium">Medium</span> <span
                    class="bold">Bold</span></h4>
                    <hr style="margin-bottom: 10px">
            <h5>Heading 5 Regular</h5>
            <h5><span class="light">Light</span> <span>Regular</span> <span class="medium">Medium</span> <span
                    class="bold">Bold</span></h5>
                    <hr style="margin-bottom: 10px">
            <h6>Heading 6 Regular</h6>
            <h6><span class="light">Light</span> <span>Regular</span> <span class="medium">Medium</span> <span
                    class="bold">Bold</span></h6>
        </div>

        <h2 class="mt-10">Buttons</h2>
        <div>
            {{-- Dark Btns --}}
            <div class="btn-holder">
                <button class="btn-lgfb btn-lgfb--regular btn-lgfb--dark fs-base">
                    Button <i class="fa fa-arrow-right"></i></button>
                <button class="btn-lgfb btn-lgfb--sm btn-lgfb--dark fs-sm"> Button  <i class="fa fa-arrow-right"></i></button>
                <button class="btn-lgfb btn-lgfb--xs btn-lgfb--dark fs-xs">
                     Button <i class="fa fa-arrow-right"></i></button>
            </div>

            {{-- Outline Btns --}}
            <div class="btn-holder">
                <button class="btn-lgfb btn-lgfb--regular btn-lgfb--outline fs-base">
                    Button<i class="fa fa-arrow-right"></i></button>
                <button class="btn-lgfb btn-lgfb--sm btn-lgfb--outline fs-sm">Button <i class="fa fa-arrow-right"></i></button>
                <button class="btn-lgfb btn-lgfb--xs btn-lgfb--outline fs-xs">
                     Button <i class="fa fa-arrow-right"></i></button>
            </div>

            {{-- Outline Btns --}}
            <div class="btn-holder">
                <button class="btn-lgfb btn-lgfb--regular btn-lgfb--default fs-base">
                    Button<i class="fa fa-arrow-right"></i></button>
                <button class="btn-lgfb btn-lgfb--sm btn-lgfb--default fs-sm">Button <i class="fa fa-arrow-right"></i></button>
                <button class="btn-lgfb btn-lgfb--xs btn-lgfb--default fs-xs">
                     Button <i class="fa fa-arrow-right"></i></button>
            </div>

            {{-- Disabled Btns --}}
            <div class="btn-holder">
                <button class="btn-lgfb btn-lgfb--regular btn-lgfb--disabled fs-base" disabled>
                    Button<i class="fa fa-arrow-right"></i></button>
                <button class="btn-lgfb btn-lgfb--sm btn-lgfb--disabled fs-sm" disabled>Button<i class="fa fa-arrow-right"></i></button>
                <button class="btn-lgfb btn-lgfb--xs btn-lgfb--disabled fs-xs">
                     Button<i class="fa fa-arrow-right" disabled></i></button>
            </div>
        </div>

        <h2 class="mt-10">Shadows</h2>
        <div class="box-holder">
            <div class="color-box shadow-100"></div>
            <div class="color-box shadow-200"></div>
            <div class="color-box shadow-300"></div>
            <div class="color-box shadow-400"></div>
            <div class="color-box shadow-500"></div>
            <div class="color-box shadow-600"></div>
            <div class="color-box shadow-700"></div>
            <div class="color-box shadow-800"></div>
        </div>

        <h2 class="mt-10">Inputs</h2>
        <div class="form-holder">
            <fieldset>
                <input type="text" placeholder="Placeholder">
            </fieldset>
            <fieldset>
                <select name="select-example" id="select-example">
                    <option value="">Example Option 1</option>
                    <option value="">Example Option 2</option>
                    <option value="">Example Option 3</option>
                    <option value="">Example Option 4</option>
                    <option value="">Example Option 5</option>
                </select>
            </fieldset>
            <fieldset>
                <label for="labelled-input-1">Label</label>
                <input type="text" id="labelled-input-1">
            </fieldset>
            <fieldset>
                <label for="labelled-input-2">Label</label>
                <p class="input-desc">Description text lorem ipsum</p>
                <input type="text" id="labelled-input-2">
            </fieldset>
            <fieldset class="fieldset--checkbox">
                <input type="checkbox" id="checkbox-example-1">
                <label for="checkbox-example-1">Label</label>
            </fieldset>
            <fieldset class="fieldset--checkbox">
                <input type="checkbox" id="checkbox-example-2">
                <div class="fieldset__side">
                    <label for="checkbox-example-2">Label</label>
                    <p class="input-desc">Description text lorem ipsum</p>
                </div>
            </fieldset>
            <fieldset class="fieldset--radio">
                <input type="radio" id="radio-example-1">
                <label for="radio-example-1">Label</label>
            </fieldset>
            <fieldset class="fieldset--radio">
                <input type="radio" id="radio-example-2">
                <div class="fieldset__side">
                    <label for="radio-example-2">Label</label>
                    <p class="input-desc">Description text lorem ipsum</p>
                </div>
            </fieldset>
        </div>
    </div>

    <x-react
      id="ThisIsID"
      component="ReactTest"
      :properties="[
          'string' => 'I am string',
          'boolean' => false,
          'number' => 587496,
          'float' => 3.14,
          'object' => [
            'number' => 120,
            'string' => 'this is another string',
           ],
           'array' => [
             [
                'number' => 200,
                'string' => 'this is another string',
                'boolean' => false,
             ],
             [
                'number' => 2000,
                'string' => 'this is another string',
                'boolean' => false,
             ],
             [
                'number' => 1600,
                'string' => 'this is another string',
                'boolean' => true,
             ],
           ]
        ]"/>

    <x-react id="DoesNotExist" component="MissingComponent" />

    <style>
        .box-holder {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .color-box {
            width: 160px;
            height: 66px;
            border-radius: 12px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .btn-holder {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 10px;
        }

        .form-holder {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
    </style>
@endsection
