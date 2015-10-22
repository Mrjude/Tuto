/**
 * Created by M-JUDE on 2015/10/21.
 */
function oCopy(obj){
    obj.select();
    js=obj.createTextRange();
    js.execCommand("Copy");
};
function sendtof(url){
    window.clipboardData.setData('Text',url);
};
function select_format(){
    var on=document.getElementByIdx_x('fmt').checked;
    document.getElementByIdx_x('site').style.display=on?'none':'';
    document.getElementByIdx_x('sited').style.display=!on?'none':'';
};
var flag=false;
function DrawImage(ImgD){
    var image=new Image();
    image.src=ImgD.src;
    if(image.width>0&&image.height>0){
        flag=true;
        if(image.width/image.height>=120/80){
            if(image.width>120){
                ImgD.width=120;
                ImgD.height=(image.height*120)/image.width;
            }else {
                ImgD.width=image.width;
                ImgD.height=image.height;
            };
            ImgD.alt=image.width+"¡Á"+image.height;
        }else {
            if(image.height>80){
                ImgD.height=80;
                ImgD.width=(image.width*80)/image.height;
            }else {
                ImgD.width=image.width;
                ImgD.height=image.height;
            };
            ImgD.alt=image.width+"¡Á"+image.height;
        }
    };
};
function FileChange(Value){
    flag=false;
    document.all.uploadimage.width=10;
    document.all.uploadimage.height=10;
    document.all.uploadimage.alt="";
    document.all.uploadimage.src=Value;
};
