let community = document.querySelector('#community');
let year = document.querySelector('#year');
let course = document.querySelector('#courses');
let submit = document.querySelector("#submit");
let root = document.querySelector("#root");
let list_title = document.querySelector("#list-title");

$url = "ajax/courseAjaxExp.php?mode=community";

fetch($url, {
    method: "GET",
    headers: {
        "Content-Type": "application/json"
    }
})
.then(response => {
    // Check if the response is ok (status in the range of 200-299)
    if (!response.ok) {
        throw new Error('Network response was not ok ' + response.statusText);
    }
    return response.json(); // Parse the JSON from the response
})
.then(data => {
    console.log(data.result); // Log the entire fetched dat
    communities = new Set(data.result.map(item => item.community));
    communities.forEach(e => {
        let option = document.createElement("option");
        option.value = e
        option.textContent = e
        community.appendChild(option);
    });

        year.addEventListener('change', ()=>{
            course.innerHTML = "";
            let courses = new Set(data.result
                .filter(item => item.course_date.split('/')[0] === year.value)
                .map(item => item.course_title) // Get the course titles
            );
            console.log("courses is : ", courses);
            courses.forEach(e => {
                let option = document.createElement("option");
                option.value = e
                option.textContent = e
                course.appendChild(option);
            });
        })

    submit.addEventListener('click', (e)=>{
        list_title.textContent = "دوره " + course.value + " انجمن " + community.value + " سال " + year.value;
        root.innerHTML = "";
        let data_fetched = data.result.filter(item => item.community === community.value && item.course_date.split('/')[0] === year.value && item.course_title === course.value);
        let i = 0;
        data_fetched.forEach(item=>{
            i++;
            let tr = document.createElement('tr');
            tr.innerHTML = `<td>${i}</td>
                            <td>${item.st_fname} ${item.st_lname}</td>
                            <td>${item.st_code}</td>
                            <td>${item.field}</td>`

            root.appendChild(tr);
            tr = "";
        })
        if(root.innerHTML === ""){
            let tr = document.createElement("tr");
            let td = document.createElement("td")
            td.textContent = "داده ای یافت نشد";
            td.setAttribute('colspan', 4);
            tr.appendChild(td);
            tr.classList.add('text-muted', 'text-center')
            root.appendChild(tr);
        }

    })
})
.catch(error => {
    console.error('There has been a problem with your fetch operation:', error);
});
 
