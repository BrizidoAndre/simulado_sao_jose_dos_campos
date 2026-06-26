<x-layout>
    <h1>Login</h1>
    <x-form action="{{route('auth.logon')}}">
        <x-field name="username">Username</x-field>
        <x-field name="password" type="password">Password</x-field>
        <button class="btn btn-primary">Login</button>
    </x-form>
</x-layout>
