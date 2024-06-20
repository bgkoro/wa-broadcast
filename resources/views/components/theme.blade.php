@php
    $theme = Cache::rememberForever('theme', function () {
        return \App\Models\Theme::find(1);
    });
@endphp
<style>
    :root {
        --primary-50: {{ $theme->primary[50] }};
        --primary-100: {{ $theme->primary[100] }};
        --primary-200: {{ $theme->primary[200] }};
        --primary-300: {{ $theme->primary[300] }};
        --primary-400: {{ $theme->primary[400] }};
        --primary-500: {{ $theme->primary[500] }};
        --primary-600: {{ $theme->primary[600] }};
        --primary-700: {{ $theme->primary[700] }};
        --primary-800: {{ $theme->primary[800] }};
        --primary-900: {{ $theme->primary[900] }};
        --primary-950: {{ $theme->primary[950] }};

        /* Add more as needed */
        --secondary-50: {{ $theme->secondary[50] }};
        --secondary-100: {{ $theme->secondary[100] }};
        --secondary-200: {{ $theme->secondary[200] }};
        --secondary-300: {{ $theme->secondary[300] }};
        --secondary-400: {{ $theme->secondary[400] }};
        --secondary-500: {{ $theme->secondary[500] }};
        --secondary-600: {{ $theme->secondary[600] }};
        --secondary-700: {{ $theme->secondary[700] }};
        --secondary-800: {{ $theme->secondary[800] }};
        --secondary-900: {{ $theme->secondary[900] }};
        --secondary-950: {{ $theme->secondary[950] }};

        /* Add more as needed */
        --danger-50: {{ $theme->danger[50] }};
        --danger-100: {{ $theme->danger[100] }};
        --danger-200: {{ $theme->danger[200] }};
        --danger-300: {{ $theme->danger[300] }};
        --danger-400: {{ $theme->danger[400] }};
        --danger-500: {{ $theme->danger[500] }};
        --danger-600: {{ $theme->danger[600] }};
        --danger-700: {{ $theme->danger[700] }};
        --danger-800: {{ $theme->danger[800] }};
        --danger-900: {{ $theme->danger[900] }};
        --danger-950: {{ $theme->danger[950] }};

        /* Add more as needed */
        --warning-50: {{ $theme->warning[50] }};
        --warning-100: {{ $theme->warning[100] }};
        --warning-200: {{ $theme->warning[200] }};
        --warning-300: {{ $theme->warning[300] }};
        --warning-400: {{ $theme->warning[400] }};
        --warning-500: {{ $theme->warning[500] }};
        --warning-600: {{ $theme->warning[600] }};
        --warning-700: {{ $theme->warning[700] }};
        --warning-800: {{ $theme->warning[800] }};
        --warning-900: {{ $theme->warning[900] }};
        --warning-950: {{ $theme->warning[950] }};


        /* Add more as needed */
        --success-50: {{ $theme->success[50] }};
        --success-100: {{ $theme->success[100] }};
        --success-200: {{ $theme->success[200] }};
        --success-300: {{ $theme->success[300] }};
        --success-400: {{ $theme->success[400] }};
        --success-500: {{ $theme->success[500] }};
        --success-600: {{ $theme->success[600] }};
        --success-700: {{ $theme->success[700] }};
        --success-800: {{ $theme->success[800] }};
        --success-900: {{ $theme->success[900] }};
        --success-950: {{ $theme->success[950] }};
    }
</style>
