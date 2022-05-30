@push('css')
<style>
    img {
        max-width: 100%;
        display: block;
    }

    .slide {
        max-width: 380px;
        margin: 20px auto;
        display: grid;
        box-shadow: 0 4px 20px 2px rgba(0, 0, 0, 0.4);
    }

    .slide-items {
        position: relative;
        grid-area: 1/1;
        border-radius: 5px;
        overflow: hidden;
    }

    .slide-nav {
        grid-area: 1/1;
        z-index: 1;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: auto 1fr;
    }

    .slide-nav button {
        -webkit-appearance: none;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        opacity: 0;
    }

    .slide-items>* {
        position: absolute;
        top: 0px;
        opacity: 0;
        pointer-events: none;
    }

    .slide-items>.active {
        position: relative;
        opacity: 1;
        pointer-events: initial;
    }

    .slide-thumb {
        display: flex;
        grid-column: 1 / 3;
    }

    .slide-thumb>span {
        flex: 1;
        display: block;
        height: 3px;
        background: rgba(0, 0, 0, 0.4);
        margin: 5px;
        border-radius: 3px;
        overflow: hidden;
    }

    .slide-thumb>span.active::after {
        content: '';
        display: block;
        height: inherit;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 3px;
        transform: translateX(-100%);
        animation: thumb 5s forwards linear;
    }

    @keyframes thumb {
        to {
            transform: initial;
        }
    }

    :root {
        --size-border: 4px;
    }

    .avatar {
        align-items: center;
        background-image: linear-gradient(45deg, #981313 5%, #7a1515 15%, #981313 30%, #640000 45%, #7a1515 70%, #640000 80%, #7a1515 95%);
        box-sizing: border-box;
        display: flex;
        height: auto;
        max-width: 180px;
        justify-content: center;
        overflow: hidden;
        padding: var(--size-border);
        width: auto;
        margin: auto;
    }

    .avatar,
    .avatar>img {
        border: var(--size-border) solid var(--color-background, white);
        border-radius: 50%;
    }

    .avatar>img {
        border-width: calc(0.5 * var(--size-border));
        height: auto;
        margin: 0;
        transform: scale(1.1);
        transition: transform 0.6s ease-in-out;
        width: 100%;
    }

    .avatar.has-story img {
        transform: scale(1);
    }
</style>
@endpush

@push('script')
<script>
    setInterval(() => document.querySelector('.avatar').classList.toggle('has-story'), 1500);

    class SlideStories {
        constructor(id) {
            this.slide = document.querySelector(`[data-slide="${id}"]`);
            this.active = 0;
            this.init();
        }

        activeSlide(index) {
            this.active = index;
            // alert(index);
            this.items.forEach((item) => item.classList.remove('active'));
            this.items[index].classList.add('active');
            this.thumbItems.forEach((item) => item.classList.remove('active'));
            this.thumbItems[index].classList.add('active');
            this.autoSlide();
        }

        prev() {
            if (this.active > 0) {
                this.activeSlide(this.active - 1);
            } else {
                // this.activeSlide(this.items.length - 1);
                exitFullScreen();
                $('#storymokultur').hide();
            }
        }

        next() {
            if (this.active < this.items.length - 1) {
                this.activeSlide(this.active + 1);
            } else {
                exitFullScreen();
                $('#storymokultur').hide();
            }
        }

        addNavigation() {
            const nextBtn = this.slide.querySelector('.slide-next');
            const prevBtn = this.slide.querySelector('.slide-prev');
            nextBtn.addEventListener('click', this.next);
            prevBtn.addEventListener('click', this.prev);
        }

        addThumbItems() {
            this.items.forEach(() => (this.thumb.innerHTML += `<span></span>`));
            this.thumbItems = Array.from(this.thumb.children);
        }

        autoSlide() {
            clearTimeout(this.timeout);
            this.timeout = setTimeout(this.next, 8000);
        }

        init() {
            this.next = this.next.bind(this);
            this.prev = this.prev.bind(this);
            this.items = this.slide.querySelectorAll('.slide-items > *');
            this.thumb = this.slide.querySelector('.slide-thumb');
            this.addThumbItems();
            this.activeSlide(0);
            this.addNavigation();
        }
    }

    new SlideStories('slide');

    function goFullScreen(){
        var elem = document.getElementById('storymokultur');
        if(elem.requestFullscreen){
            elem.requestFullscreen();
        }
        else if(elem.mozRequestFullScreen){
            elem.mozRequestFullScreen();
        }
        else if(elem.webkitRequestFullscreen){
            elem.webkitRequestFullscreen();
        }
        else if(elem.msRequestFullscreen){
            elem.msRequestFullscreen();
        }
    }

    function exitFullScreen(){
        if(document.exitFullscreen){
            document.exitFullscreen();
        }
        else if(document.mozCancelFullScreen){
            document.mozCancelFullScreen();
        }
        else if(document.webkitExitFullscreen){
            document.webkitExitFullscreen();
        }
        else if(document.msExitFullscreen){
            document.msExitFullscreen();
        }
    }
    
$('#buttonstory').click(function() {
    $('#storymokultur').show();
    goFullScreen();
});
</script>
@endpush

<div class="jumbotron jumbotron-fluid primary-pattern-1 pb-0">
    <div class="mini-section">
        <div class="container">
            <div class="card card-body bd-radius-8 shadow border-0">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-12 my-2">
                        <div class="d-flex justify-content-center">
                            <a href="#" id="buttonstory" class="avatar has-story">
                                <img class="rounded-circle img-cover img-fluid"
                                    src="{{ asset('storage/' . $user->profile_pic) }}" alt="...">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-8 d-flex flex-column align-self-center my-2">
                        <small>Active since {{ $user->created_at->format('M Y') }}</small>
                        <div class="my-1">
                            <h1 class="no-pm">{{ $user->name }}</h1>
                        </div>
                        <p class="text-secondary">{{ $user->description }}</p>
                        <div class="flex-row">
                            @if ($user->facebook)
                            <a class="btn btn-facebook" href="https://facebook.com/{{ $user->facebook }}"
                                target="_blank">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                            @endif
                            @if($user->instagram)
                            <a class="btn btn-instagram" href="https://instagram.com/{{ $user->instagram }}"
                                target="_blank">
                                <i class="fab fa-instagram"></i> Instagram
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div data-slide="slide" id="storymokultur" class="slide" style="display: none">
    <div class="slide-items">
        <img src="https://wallpapercave.com/wp/wp9464930.jpg" alt="Img 1">
        <img src="https://wallpaper.dog/large/20521641.jpg" alt="Img 2">
        <img src="https://www.itl.cat/pngfile/big/285-2859620_wallpaper-1080x1920.jpg" alt="Img 3">
    </div>
    <nav class="slide-nav">
        <div class="slide-thumb"></div>
        <button class="slide-prev">Prev</button>
        <button class="slide-next">Next</button>
    </nav>
</div>