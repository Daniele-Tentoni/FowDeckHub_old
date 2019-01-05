$(document).ready(function() {
    $("form").submit(function(e) {
        e.preventDefault();
    });

    $(".decklist_importer").click(function() {
        var text = $("#GachaText").val();
        var panel = $(".import_decklist_panel");
        var container = $(".import_decklist_panel .e-panel");
        $(container).show();
        container = $(".import_decklist_panel .e-body");
        $(container).html("");
        var deck_id = $(this).data("decklist");
        if (text.length <= 0 || container.length <= 0 || deck_id.length <= 0) {
            console.log(text);
            console.log(container);
            console.log(deck_id);
            $(container).html("Incorrect data input.");
            console.log("Exited.");
            return false;
        }

        var res = decklist_import(container, text);
        console.log("Imported");
        if (res != false) {
            var imp = import_ajax_caller(panel, container, res, deck_id);
            if (imp != false) {
                console.log("Saved");
                $(container).append("Decklist correctly imported.");
            }
        }
    });
});

var save_base_data = function(panel, id) {
    $(".e-panel").hide();
    $(".e-body").html("");
    var entities = [];
    var values = [];
    $(panel + " .add_item").each(function(e) {
        var val = 0;
        if ($(this).attr("type") == "checkbox") {
            val = $(this).prop("checked") == true ? 1 : 0;
        } else {
            val = $(this).val();
        }
        values.push(val);
        entities.push($(this).attr('id'));
    });

    var string_data = "Id=" + id;
    for (var i = 0; i < entities.length; i++) {
        string_data += "&" + entities[i] + '=' + values[i];
    }
    console.log(string_data);

    var form = $(panel);
    var action = form.attr("action");
    var method = form.attr("method");
    if (form.length > 0) {
        console.log(action);
        console.log(method);
    }

    $.ajax({
        type: method,
        url: action,
        dataType: "json",
        data: string_data,
        success: function(msg) {
            $(panel + " .e-panel").show();
            if (msg["result"] === true) {
                $(panel + " .e-body").html("<span class=\"alert alert-success\">" + msg["message"] + "</span>");
            } else {
                $(panel + " .e-body").html("<span class=\"alert alert-warning\">" + msg["message"] + "</span>");
                console.log(msg.error);
                console.log(msg["number"]);
                console.log(msg["message"]);
            }
        },
        error: function(msg) {
            console.log(msg);
            console.log("error");
            $(panel + " .e-panel").show();
            $(panel + " .e-body").html("<span class=\"alert alert-danger\">" + msg["message"] + "</span>");
        }
    });
};

/******************************************************************************
 ***                      INIZIO DECKLIST IMPORTER                          ***
 ******************************************************************************/
function import_card(part, cname, cquantity) {
    // Questa parte dovrà effettuare la chiamata ajax al server per il salvataggio.
    part.deck.push({ name: cname, count: cquantity });
    part.c += Number(cquantity);
};

var start_deck = function() {
    return {
        name: "",
        code: "",
        ruler: {
            deck: [],
            c: 0,
            n: 0
        },
        rune: {
            deck: [],
            c: 0,
            n: 0
        },
        main: {
            deck: [],
            c: 0,
            n: 0
        },
        stone: {
            deck: [],
            c: 0,
            n: 0
        },
        side: {
            deck: [],
            c: 0,
            n: 0
        }
    };
};

var validate_deck = function(name, num, min, max) {
    /*
     * Questa funzione servirebbe per controllare se gli input delle carte sono sempre corretti.
     * Da usare prevalentemente per i mazzi o per le carte come le rune.
     * Implementare meglio la qualità dell'import delle carte come i dodici kimono.
     */
    if (num < min || num > max) {
        $(container).append(part[0] + " non valido : " + part[2] + " carte <br />");
        return true;
    } else {
        return false;
    }
};

var decklist_import = function(container, text) {
    var deck = start_deck();
    var elems = text.split('\n');
    var not_valid = false;
    // Scomporre tutto quel testo in varie sezioni. Provare con un trim iniziale.
    $(elems).each(function() {
        if (not_valid == true) {
            console.log("Non valido");
            return false;
        }

        var part = this.split(/( x )/);
        switch (part[0]) {
            // Questi primi casi servono per capire in quale deck ci stiamo movendo.
            case "Ruler":
                not_valid = validate_deck(part[0], part[2], 1, 2);
                deck.ruler.n = part[2];
                $(container).append("Ruler area contains: " + deck.ruler.n + " cards <br />");
                break;
            case "Deck":
            case "Main Deck":
                not_valid = validate_deck(part[0], part[2], 40, 60);
                deck.main.n = part[2];
                $(container).append("Main deck contains: " + deck.main.n + " cards <br />");
                break;
            case "Rune Deck":
                not_valid = validate_deck(part[0], part[2], 0, 5);
                deck.rune.n = part[2];
                $(container).append("Rune deck contains: " + deck.rune.n + " cards <br />");
                break;
            case "Stone Deck":
                not_valid = validate_deck(part[0], part[2], 10, 20);
                deck.stone.n = part[2];
                $(container).append("Stone deck contains: " + deck.stone.n + " cards <br />");
                break;
            case "Side Board":
            case "Side Deck":
                not_valid = validate_deck(part[0], part[2], 0, 15);
                deck.side.n = part[2];
                $(container).append("Side deck contains: " + deck.side.n + " cards <br />");
                break;
            case '':
                break;
            default:
                // Questi altri casi servono per riempire il deck in cui ci stiamo movendo.
                if (deck.ruler.n != 0 && deck.ruler.n != deck.ruler.c) {
                    import_card(deck.ruler, part[0], part[2]);
                    $(container).append("C " + deck.ruler.c + " of N " + deck.ruler.n + " progress<br />");
                } else if (deck.rune.n != 0 && deck.rune.n != deck.rune.c) {
                    import_card(deck.rune, part[0], part[2]);
                    $(container).append("C " + deck.rune.c + " of N " + deck.rune.n + " progress<br />");
                } else if (deck.main.n != 0 && deck.main.n != deck.main.c) {
                    import_card(deck.main, part[0], part[2]);
                    $(container).append("C " + deck.main.c + " of N " + deck.main.n + " progress<br />");
                } else if (deck.stone.n != 0 && deck.stone.n != deck.stone.c) {
                    import_card(deck.stone, part[0], part[2]);
                    $(container).append("C " + deck.stone.c + " of N " + deck.stone.n + " progress<br />");
                } else if (deck.side.n != 0 && deck.side.n != deck.side.c) {
                    import_card(deck.side, part[0], part[2]);
                    $(container).append("C " + deck.side.c + " of N " + deck.side.n + " progress<br />");
                } else {
                    var secpart = part[0].split(/:/);
                    switch (secpart[0]) {
                        case "Gachalog Code":
                            deck.code = secpart[1];
                            $(container).append("Gachalog Code: " + deck.code + "<br />");
                            break;
                        case "Recipe Name":
                            deck.name = secpart[1];
                            $(container).append("Recipe Name: " + deck.name + "<br />");
                            break;
                        default:
                            $(container).append("Error with + " + part[0] + "<br />");
                            break;
                    }
                }
                break;
        }
    });

    if (not_valid) {
        console.log("Non valido");
        return false;
    } else {
        console.log("Non valido");
        return deck;
    }
};

var import_ajax_caller = function(panel, container, decks, deck_id) {
    var deck_string = JSON.stringify(decks);
    var string_data = "Id=" + deck_id + "&Deck=" + deck_string;
    console.log(string_data);

    var form = $(panel);
    var action = form.attr("action");
    var method = form.attr("method");

    $.ajax({
        type: method,
        url: action,
        dataType: "json",
        data: string_data,
        success: function(msg) {
            if (msg["result"] === true) {
                $(container).html("<span class=\"alert alert-success\">" + msg["message"] + "</span>");
            } else {
                $(container).html("<span class=\"alert alert-warning\">" + msg["message"] + "</span>");
                console.log(msg.error);
                console.log(msg.number);
                console.log(msg.content);
                return false;
            }
        },
        error: function(msg) {
            console.log(msg);
            console.log("error");
            $(container).show();
            $(container).html("<span class=\"alert alert-danger\">" + JSON.stringify(msg.responseText) + "</span>");
            return false;
        }
    });
}