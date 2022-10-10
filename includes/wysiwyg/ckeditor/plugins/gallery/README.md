# Gallery Widget

This widgets serves as a container for multiple instances of other media widgets in order to display them as a gallery, p.e. with the aid of flexbox or grid layout, or as a slider/carousel, p.e. with your own implementation or one of your choice, or as whatever else comes into your mind.

**This widget itself does not provide any slider/carousel functionality!** It only provides a HTML structure suitable for aforementioned purposes and allows to maintain it within the editor.

The resulting HTML will be p.e.

    <figure class="gallery">
        <div class="content">
            <figure class="image">
                <img src="..." />
                <figcaption>
                    ...
                </figcaption>
            </figure>
            ...
        </div>
        <figcaption>
            ...
        </figcaption>
    </figure>

## Technical

At current state this widget

- only allows *figure* elements as child elements (filtering takes place on `downcast`),
- does not offer any configuration options and
- does not offer a dialog to set custom classes or values.

This could change in one of the future versions.

## Demo

https://akilli.github.io/rte/ck4
