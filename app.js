fetch('https://api.codenation.dev/v1/challenge/dev-ps/generate-data?token=45296e6a02a3341dde66779908ee84ec021c6af8')
.then(response => {
    console.log(response);
    // const file = new File(response, 'answer.json', {
    //     type: 'text/pain'
    // });
    var file = new File(["foo"], "foo.txt", {
        type: "text/plain",
      });
})
.catch(error => console.log(error));