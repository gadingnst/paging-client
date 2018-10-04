


function fetchPaging(whichPage){
    initPage(whichPage)
}


function initPage(pageParam){
    fetch(`/Paging/api.php?page=${pageParam}`)
        .then(r=> r.json())
        .then(rJson=>{
            const {data , isLast , pageEl} = rJson

            $('#page-el-container').empty()
            $('#tbody').empty()

            data.forEach(v=>{
                $('#tbody').append(`
                    <tr>
                        <td>${v.id}</td>
                        <td>${v.name}</td>
                        <td>${v.address}</td>
                    </tr>
                `)
            })

            pageEl.forEach(v=>{
                $('#page-el-container').append(`
                    <a
                        style="cursor:pointer;"
                        onclick="fetchPaging('${v}')">
                        ${v}
                    </a>
                `)
            })
            
            const firstIdx = pageEl[0]

            if(firstIdx !== 1) {
                const beforeEl = pageEl[0] - 1
                $('#page-el-container').prepend(`
                    <a
                        style="cursor:pointer;"
                        onclick="fetchPaging('${beforeEl}')"
                        >
                        BACK
                    </a>
                `)
            }

            if(!isLast){
                const lastEl = pageEl[pageEl.length - 1] + 1
                $('#page-el-container').append(`
                    <a
                        style="cursor:pointer;"
                        onclick="fetchPaging('${lastEl}')">
                        NEXT
                    </a>
                `)
            }
        })
        .catch(err=>{
            console.error(err)
        })
}

initPage(1)