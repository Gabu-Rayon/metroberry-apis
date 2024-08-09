<div class="modal-content">
    <div class="card-header my-3 p-2 border-bottom text-center">
        <h4>{{ $organisation->user->name }}</h4>
    </div>
    <div class="modal-body d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{ url('storage/' . $organisation->user->avatar) }}" alt="Avatar" class="w-25 h-25 rounded-full" />
            <div class="details mx-5">
                <p>
                    <i class="fas fa-user"></i>
                    {{ $organisation->user->name }}
                </p>
                <p>
                    <i class="fas fa-envelope"></i>
                    {{ $organisation->user->email }}
                </p>
                <p>
                    <i class="fas fa-phone"></i>
                    {{ $organisation->user->phone }}
                </p>
                <p>
                    <i class="fas fa-building"></i>
                    {{ $organisation->organisation_code }}
                </p>
            </div>
        </div>
        <div id="map" class="my-5" style="height: 200px; width: 200px">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Close
        </button>
    </div>
</div>

<script>
    (g => {
        var h, a, k, p = "The Google Maps JavaScript API",
            c = "google",
            l = "importLibrary",
            q = "__ib__",
            m = document,
            b = window;
        b = b[c] || (b[c] = {});
        var d = b.maps || (b.maps = {}),
            r = new Set,
            e = new URLSearchParams,
            u = () => h || (h = new Promise(async (f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + "");
                for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                d[q] = f;
                a.onerror = () => h = n(Error(p + " could not load."));
                a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                m.head.append(a)
            }));
        d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() =>
            d[l](f, ...n))
    })({
        key: "AIzaSyBjAxAszIxcGy7sHQxpFh0c1EDs-3AO76Q",
        v: "weekly",
    });

    let map;

    async function initMap() {
        // The location of Uluru
        const position = {
            lat: -25.344,
            lng: 131.031
        };
        // Request needed libraries.
        //@ts-ignore
        const {
            Map
        } = await google.maps.importLibrary("maps");
        const {
            AdvancedMarkerElement
        } = await google.maps.importLibrary("marker");

        // The map, centered at Uluru
        map = new Map(document.getElementById("map"), {
            zoom: 4,
            center: position,
            mapId: "1ff9a8b756cebdc2",
        });

        const marker = new AdvancedMarkerElement({
            map: map,
            position: position,
            title: "Uluru",
        });
    }

    initMap();
</script>
