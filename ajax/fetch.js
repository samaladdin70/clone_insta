const follows = (id, followed) => {
        const url = '../agents/followsHandle.php?followedId=' + followed;
        fetch(url).then(response => response.text()).then(data => {
            document.getElementById(id).innerText = data;
        })
    };

    const fetchText = (id, url)=>{
        let content = "";
        fetch(url).then(response=>response.json()).then(data=>{
            if (data == 'No Comments') {
                document.getElementById(id).innerHTML = data;
            } else {
                // console.log(data);
                data.forEach(element => {
                    if (element.dayDiff == 0) {
                        if (element.timeDiff.slice(0,2) == '00') {
                            if (element.timeDiff.slice(3,5) == '01') {
                                diff = element.timeDiff.slice(3,5) + ' minute ago';
                            } else {
                                diff = element.timeDiff.slice(3,5) + ' minutes ago';
                            }
                        } else if (element.timeDiff.slice(0,2) == '01') {
                            diff = element.timeDiff.slice(0,2) + ' hour ago';
                        } else {
                            diff = element.timeDiff.slice(0,2) + ' hours ago';
                        }
                    } else if (element.dayDiff == 1) {
                        diff = element.dayDiff + ' Day ago';
                    } else {
                        diff = element.dayDiff + ' Days ago';
                    }
                    content += '<div class="d-flex" style="width:100%;">'+
                                    '<div class="p-1"><img src="'+ element.img +'" style="width: 30px; height:30px;         border-radius:50%;">'
                                    +'</div>'+
                                    '<div class="d-flex flex-column mb-3">'+
                                        '<div class="d-flex flex-column p-1" style="background-color: #eee; border-radius:5px;">'+
                                            '<h6>'+ element.Uname +'</h6>'+
                                            '<div style="max-width:250px;">'+element.comment+'</div>'+
                                        '</div>'+
                                        '<div style="color:grey;">'+ diff +'</div>' +
                                    '</div>'+
                                '</div>';
                });
                document.getElementById(id).innerHTML = content;
                /* to scroll to the bottom */
                // document.getElementById(id).scrollTo(0, document.getElementById(id).scrollHeight);
                /* the same as above both are right */
                document.getElementById(id).scrollTop = document.getElementById(id).scrollHeight;
            }
        })
    };