    const defaultBtn = document.querySelector("#default-btn");
                            const customBtn = document.querySelector("#custom-btn");
                            var uploaded_image = "";
                            function defaultBtnActive(){
                              defaultBtn.click();
                            }

                            defaultBtn.addEventListener("change", function(){
                              const reader = new FileReader();
                              reader.addEventListener("load", () => {
                                uploaded_image = reader.result;
                                document.querySelector("#display-img").style.backgroundImage = `url(${uploaded_image})`;
                              });
                              reader.readAsDataURL(this.files[0]);

                               
                            })