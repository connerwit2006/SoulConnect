@props(['description' => 'Geen beschrijving beschikbaar'])

<div class="leading-relaxed mt-2">
    <!-- Truncate Description To 3 Lines -->
    <p id="description"
        class="overflow-hidden text-ellipsis text-zinc-700"
        style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; max-height: 4.5em;">
        {{ $description }}
    </p>

    <!-- Read More Button -->
    <button id="readMoreBtn" class="text-blue-500 hover:underline md:mb-10">Verder lezen...</button>
</div>

<script>
    <!-- Wait For The DOM To Fully Load -->
    document.addEventListener("DOMContentLoaded", function () {
        const readMoreBtn = document.getElementById("readMoreBtn");
        const description = document.getElementById("description");

        <!-- Add Click Functionality -->
        readMoreBtn.addEventListener("click", function () {
            if (description.style.webkitLineClamp === "3" || description.style.webkitLineClamp === "") {
                description.style.webkitLineClamp = "unset";
                description.style.maxHeight = "none";
                this.textContent = "Minder lezen...";
            } else {
                description.style.webkitLineClamp = "3";
                description.style.maxHeight = "4.5em";
                this.textContent = "Verder lezen...";
            }
        });
    });
</script>
