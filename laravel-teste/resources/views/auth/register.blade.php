<x-layout>
    <h1>Register</h1>
    <x-form action="{{route('auth.signup')}}">
        <x-field name="username">Username</x-field>
        <x-field name="password" type="password">Password</x-field>
        <button class="btn btn-primary">Submit</button>
    </x-form>
</x-layout>
