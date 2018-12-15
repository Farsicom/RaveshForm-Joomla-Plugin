function showRaveshFormDialog() {
    var rvc = new RaveshFrameWork();

    var rvcLang = '';
    if (RaveshFormLang == 'Persian (IR)') rvcLang = 'fa'; else rvcLang = 'en';
    var isCRM = RaveshFormIsCRM === 'true';
    var isFormican = RaveshFormIsFormican === 'true';


    //Resources -----------------------
    var rvcResource = {
        fa: {
            dir: 'rtl',
            floatLeft: 'left',
            floatRight: 'right',
            modalTitle: 'فرم‌ساز <span style="color: #03a9f4">روش</span>',
            modalDescription: 'افزونه‌ی اتصال وردپرس به فرم‌ساز رَوش',
            modalTitle2: 'فرم‌ساز <span style="color: #03a9f4">فرم‌افزار</span>',
            modalDescription2: 'افزونه‌ی اتصال وردپرس به فرم‌افزار',
            showTypeInline: 'اسکریپت',
            showTypeDialog: 'نمایش پنجره',
            showTypeLink: 'لینک',
            showTypeFab: 'دکمه شناور',
            serverUrl: 'آدرس سرور',
            domain: 'نام دامنه',
            domain2: 'شناسه‌ی امنیتی',
            formId: 'شناسه‌ی فرم',
            showType: 'نحوه نمایش',
            linkTitle: 'عنوان',
            iconTitle: 'افزودن فرم',
            create: 'ایجاد',
            viewForm: 'مشاهده‌ی فرم',
            enterDomain: 'نام دامنه را وارد نمایید.',
            enterDomain2: 'شناسه‌ی امنیتی را وارد نمایید.',
            enterServerUrl: 'آدرس سرور را وارد نمایید.',
            enterFormId: 'شناسه‌ی فرم را وارد نمایید.'
        },
        en: {
            dir: 'ltr',
            floatLeft: 'right',
            floatRight: 'left',
            modalTitle: '<span style="color: #03a9f4">Ravesh</span> Form Builder',
            modalDescription: 'Connect Ravesh Form Builder & wordpress',
            modalTitle2: '<span style="color: #03a9f4">Formican</span> Form Builder',
            modalDescription2: 'Connect Formican & wordpress',
            showTypeInline: 'Inline',
            showTypeDialog: 'Show Dialog',
            showTypeLink: 'Link',
            showTypeFab: 'Float Action Button',
            serverUrl: 'Server Url',
            domain: 'Domain',
            domain2: 'Secret code',
            formId: 'Form Id',
            showType: 'Show Type',
            linkTitle: 'Title',
            iconTitle: 'Add Form',
            create: 'Create',
            viewForm: 'View form',
            enterDomain: 'Please enter domain',
            enterDomain2: 'Please enter Secret code',
            enterServerUrl: 'Please enter server url',
            enterFormId: 'Please enter form id'
        }
    };
    var res = rvcResource[rvcLang];


    //Style -----------------------
    var mainCss =
        '.rvc-modal {display: none;position: fixed;z-index: 99999;left: 0;top: 0;width: 100%;height: 100%;overflow: auto;background-color: rgba(0, 0, 0, 0.4);}' +
        '.rvc-modal-content {background-color: #fefefe;margin: 15% auto;padding: 20px;border: 1px solid #888;width: 366px;font-family: tahoma;overflow: hidden;}' +
        '.rvc-close {color: #aaa;float: ' + res.floatLeft + ';font-size: 28px;font-weight: bold;}' +
        '.rvc-modal-title {font-size: 18px;}' +
        '.rvc-modal-detail {color: gray;margin: 5px 0 20px;}' +
        '.rvc-close:hover,.rvc-close:focus {color: black;text-decoration: none;cursor: pointer;}' +
        '.rvc-row {line-height: 25px;margin: 10px;overflow: hidden;}' +
        '.rvc-row span {min-width: 130px;float: ' + res.floatRight + ';font-size:12px;}' +
        '.rvc-row input,.rvc-row select {width: 200px;float: ' + res.floatRight + ';height: 30px;box-sizing:border-box;}' +
        '.rvc-modal .button{width:70px;margin-top:10px}';
    rvc.addCssStyleTag(mainCss);


    //Define Element -----------------------
    var modal = rvc.createElement('div', 'rvc-modal');
    var modalContent = rvc.createElement('div', 'rvc-modal-content');
    var modalTitle = rvc.createElement('div', 'rvc-modal-title');
    var modalDescription = rvc.createElement('div', 'rvc-modal-detail');
    var txtServerUrl = rvc.createElement('input');
    var txtDomain = rvc.createElement('input');
    var txtFormId = rvc.createElement('input');
    var txtLinkTitle = rvc.createElement('input');
    var drdShowType = rvc.createElement('select');
    var btnCreateCode = rvc.createElement('input', 'btn button button-primary button-large');
    var btnClose = rvc.createElement('span', 'rvc-close');


    //Configuration Elements -----------------------
    modalTitle.innerHTML = isCRM ? res.modalTitle : res.modalTitle2;
    modalDescription.innerHTML = isCRM ? res.modalDescription : res.modalDescription2;
    btnClose.innerHTML = '&times;';
    modal.setAttribute('dir', res.dir);
    txtServerUrl.setAttribute('type', 'text');
    txtServerUrl.value = rvc.getCookie("server")
    txtDomain.setAttribute('type', 'text');
    txtDomain.value = rvc.getCookie("domain")
    txtFormId.setAttribute('type', 'text');
    txtLinkTitle.setAttribute('type', 'text');
    txtLinkTitle.value = res.viewForm;
    btnCreateCode.setAttribute('type', 'submit');
    btnCreateCode.value = res.create;


    var arrShowType = [['inline', res.showTypeInline], ['dialog', res.showTypeDialog], ['link', res.showTypeLink], ['fab', res.showTypeFab]]
    for (var index in arrShowType) {
        var option = rvc.createElement('option');
        option.appendChild(document.createTextNode(arrShowType[index][1]));
        option.setAttribute('value', arrShowType[index][0]);
        drdShowType.appendChild(option);
    }


    //Append Elements -----------------------
    rvc.appendChilds(modalContent, [btnClose, modalTitle, modalDescription]);
    rvc.appendChilds(modal, [modalContent]);
    rvc.appendChilds(document.body, [modal]);

    var createRow = function (title, elem) {
        var row = rvc.createElement('div', 'rvc-row');
        var span = rvc.createElement('span');
        span.appendChild(document.createTextNode(title));
        rvc.appendChilds(row, [span, elem]);
        return row;
    };

    if (isCRM) {
        rvc.appendChilds(modalContent, [
            createRow(res.serverUrl, txtServerUrl)
        ]);
    }

    rvc.appendChilds(modalContent, [
        createRow(isCRM ? res.domain : res.domain2, txtDomain),
        createRow(res.formId, txtFormId),
        createRow(res.showType, drdShowType),
        createRow(res.linkTitle, txtLinkTitle),
        createRow(' ', btnCreateCode)
    ]);

    //Methods -----------------------
    btnClose.onclick = function () {
        rvc.hide(modal);
    };
    window.onclick = function (ev) {
        if (ev.target === modal) {
            rvc.hide(modal);
        }
    };

    btnCreateCode.onclick = function () {
        if (txtDomain.value.toString() === "") {
            alert(res.enterDomain);
            txtDomain.focus();
        } else if (txtServerUrl.value.toString() === "" && isCRM) {
            alert(res.enterServerUrl);
            txtServerUrl.focus();
        } else if (txtFormId.value.toString() === "") {
            alert(res.enterFormId);
            txtFormId.focus();
        } else {
            var shortCode = '';
            if (isCRM) {
                shortCode = '[RaveshForm ' +
                                'server="' + txtServerUrl.value.toString() + '" ' +
                                'domain="' + txtDomain.value.toString() + '" ' +
                                'formid="' + txtFormId.value.toString() + '" ' +
                                'type="' + drdShowType.options[drdShowType.selectedIndex].value.toString() + '" ' +
                                'title="' + txtLinkTitle.value.toString() + '" ' +
                            ']';
            } else {
                shortCode = '[' + (isFormican ? 'Formican' : 'FormAfzar') + ' ' +
                                'secretcode="' + txtDomain.value.toString() + '" ' +
                                'formid="' + txtFormId.value.toString() + '" ' +
                                'type="' + drdShowType.options[drdShowType.selectedIndex].value.toString() + '" ' +
                                'title="' + txtLinkTitle.value.toString() + '" ' +
                            ']';
            }
            jInsertEditorText(shortCode, 'jform_articletext');
            document.cookie = "server=" + txtServerUrl.value.toString();
            document.cookie = "domain=" + txtDomain.value.toString();
            rvc.hide(modal);
        }
    }
    rvc.show(modal);


    function RaveshFrameWork() {
        var self = this;

        self.createElement = function (tagName, className) {
            var elem = document.createElement(tagName);
            if (className) {
                var arrClasses = className.split(' ');
                for (var index = 0; index < arrClasses.length; index++) {
                    elem.classList.add(arrClasses[index]);
                }
            }
            return elem;
        };
        self.appendChilds = function (parent, arrChilds) {
            for (var elem = 0; elem < arrChilds.length; elem++) {
                parent.appendChild(arrChilds[elem]);
            }
        };
        self.hide = function (elem) {
            elem.style.display = 'none';
        };
        self.show = function (elem) {
            elem.style.display = 'block';
        };
        self.addClass = function (elem, className) {
            elem.classList.add(className);
        };
        self.removeClass = function (elem, className) {
            elem.classList.remove(className);
        };
        self.addCssStyleTag = function (css) {
            var style = document.createElement('style');
            style.type = 'text/css';
            if (style.styleSheet) {
                style.styleSheet.cssText = css;
            } else {
                style.appendChild(document.createTextNode(css));
            }
            document.body.appendChild(style);
        };
        self.getCookie = function (key) {
            var cookie = document.cookie.split(';');
            for (var i = 0; i < cookie.length; i++) {
                var cke = cookie[i].trim();
                if (cke.indexOf(key + '=') >= 0) {
                    return cke.split('=')[1].toString();
                }
            }
            return '';
        };
    }
}

