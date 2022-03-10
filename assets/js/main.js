document.addEventListener("DOMContentLoaded", () => {

    // add.forEach(product => {

    let adds = document.getElementsByClassName("btnadd");

    for (const add of adds) {

        add.addEventListener("click", (e) => {

            e.preventDefault();
            let id = e.path[0].dataset.id;
            fetch("/addcart/" + id)
                .then(
                    function (reponse) {
                        return reponse.text();
                    }
                )
                .then(
                    function (reponse) {

                    }
                )


        })
    }

    // });
})