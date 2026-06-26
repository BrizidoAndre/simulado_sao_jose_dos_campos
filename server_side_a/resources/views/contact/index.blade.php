<x-layout-admin>
    <!-- Contacts -->
    <section id="contacts" class="mt-5 mb-5">
        <h2 class="mb-4"> Contact Messages </h2>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->message}}</td>
                            <td>{{$contact->created_at->format('d/m/Y')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-layout-admin>
