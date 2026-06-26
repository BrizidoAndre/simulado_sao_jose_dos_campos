<x-layout-public>
    <header class="bg-light text-center py-5">
        <div class="container">
            <h1>Welcome to PhotoPortal</h1>
            <p class="lead">Photography stories, tutorials and galleries.</p>
        </div>
    </header>

    <section class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="imgs/home1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Urban Photography</h5>
                        <p>Explore creative city photography techniques.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <img src="imgs/home2.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Nature Photography</h5>
                        <p>Capture beautiful landscapes and outdoor scenes.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <img src="imgs/home3.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Editing Workflow</h5>
                        <p>Learn simple editing techniques for better photos.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="container bg-light py-5 d-flex gap-4 align-items-center">
        <div class="col-md-5 mb-4 mb-md-0">
            <img src="imgs/about.jpg" alt="Photographer"
                 class="img-fluid rounded shadow">
        </div>
        <div class="col-md-7">
            <h2 class="mb-4">About</h2>
            <p class="lead"> Capturing moments, emotions and stories through photography. </p>
            <p> PhotoPortal was created to share the passion for photography with people from all around the world.
                Through
                landscapes, urban scenes, portraits and creative compositions, the project aims to transform everyday
                moments into
                memorable visual experiences. </p>
            <p> With years of experience in photography and photo editing, the photographer behind PhotoPortal combines
                technical
                knowledge with artistic vision to create authentic and impactful images. Beyond showcasing professional
                work, the
                platform also serves as a place to teach photography techniques, camera settings, lighting concepts and
                editing
                workflows for beginners and enthusiasts. </p>
            <p> The mission of PhotoPortal is to inspire creativity, help people improve their photography skills and
                demonstrate
                how powerful visual storytelling can be in connecting emotions and experiences. </p>
            <div class="mt-4"><a href="{{route('public.gallery')}}" class="btn btn-dark me-2"> View Gallery </a> <a
                    href="#contact"
                    class="btn btn-outline-dark">
                    Contact </a></div>
        </div>
        </div>
    </section>

    <section id="contact" class="py-5">
        <div class="container col-md-6 text-center">
            <h2 class="mb-4">Contact</h2>

            <form method="post" class="text-start" action="{{route('public.contact.store')}}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input required name="name" type="text" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input required name="email" type="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea required name="message" class="form-control" rows="5"></textarea>
                </div>

                <button class="btn btn-dark">Send</button>
            </form>
        </div>
    </section>
</x-layout-public>
