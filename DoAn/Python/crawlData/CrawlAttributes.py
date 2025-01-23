# ---------------------- Library ----------------------
import requests
import pandas as pd
from bs4 import BeautifulSoup

# ---------------------- variable ----------------------
# dynamic
output_path = r"D:\Homework\Year3\UngDungWeb_IS207.P11\DoAn"    # place save scv

Att_list = ["TÊN KHOA HỌC", "TÊN THÔNG THƯỜNG", "TÊN GỌI KHÁC", "TÊN TIẾNG ANH"]

# static
sourceUrl = "https://mowgarden.com"

subUrl = {
    "CayTrongNha": "/ban-cay-canh-trong-nha/",
    "CayNgoaiTroi": "/cay-ngoai-troi/",
    "ChauCay": "/chau-cay/",
    # "HuongDan": "/huong-dan-cay-xanh-101/"
}

main_container = {
    "divpagination": "woocommerce-pagination",
    "navpagination": "page-numbers nav-pagination links text-center",

    "divcontent": "row category-page-row",
    "divcontent_list": "products row row-small large-columns-4 medium-columns-4 small-columns-2 has-shadow row-box-shadow-2-hover has-equal-box-heights equalize-box",
    "box_image" : "box-image",
    "href_plant": "image-zoom_in",
    "box_text": "box-text box-text-products"
}

detail_container = {
    "divcontent": "col medium-12 small-12 large-9",
    
    "divimage": "product-images relative mb-half has-hover woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images",
    "slider": "flickity-slider",
    
    "divinfo": "col medium-5 small-12 large-6",
    "info_title": "product-title product_title entry-title",
    "info_price": "price-wrapper",
    "divdesription": "product-short-description",
    "divmeta": "product_meta",
    "divsku": "sku_wrapper",
    "divcategory": "posted_in"
}

''' Note HTML form

==== Get max page FROM main ====
divcontent
    divpagination
        navpagination
            li :last {2nd} -> (max page)

==== Get href to load to detail page FROM main ====
divcontent
    divcontent_list
        div
            box_image
                href_plant -> (href)
        div
            v.v
        v.v

==== Get information of plant FROM detail page ====
1. Image
divcontent
    divimage
        slider :first
            div
                a (img = href)
            div
                v,v
            v.v

2. info
divcontent
    divinfo
        divdesription
            tbody
                tr
                    td -> (attributes)
                    dt -> (value)
                tr
'''

# ---------------------- Function ----------------------

def SaveAttributesToCSV():
    for att in Att_list:
        print(att)

def ConnectionWithSoup(url):
    # Connection
    response = requests.get(url)

    if response.status_code != 200:
        print("**ERROR: Không thể truy cập web!**")
        return "error"
    
    # Get soup
    return BeautifulSoup(response.content, "html.parser")

def CrawlDatasetPlant_Detail(url, file_path):
    # Connection
    soup = ConnectionWithSoup(url)
    if soup == "error":
        return

    # ==== Get Atrributes of plant FROM detail page ====
    soup = soup.find("div", class_=detail_container["divcontent"])  

    infos = soup.find("div", class_=detail_container["divinfo"])
    
    divdes = infos.find(class_=detail_container["divdesription"])
    
    attributes = divdes.find("tbody").contents

    for att in attributes:
        if att.text == "\n":
            attributes.remove(att)

    for att in attributes:
        subatt = att.contents

        for sub in subatt:
            if sub.text == "\n":
                subatt.remove(sub)

        name_att = subatt[0].text.strip()

        if not name_att in Att_list:
            Att_list.append(name_att)

def CrawlDatasetPlant_Main(main_url, maxpag, file_path):
    for i in range(maxpag):
        # 
        print()
        print(f"----------------------- PAGE {i + 1} -----------------------")
        print()

        url = main_url + f"page/{i + 1}/"        

        # Connection
        soup = ConnectionWithSoup(url)
        if soup == "error":
            return    

        # ==== Get href to load to detail page FROM main ====
        listcontent = soup.find("div", class_=main_container["divcontent_list"]).contents
        # del listcontent[0]

        for i, content in enumerate(listcontent):
            if content.text == "\n":
                continue
            
            content = content.find(class_=main_container["box_image"]).find(class_=main_container["href_plant"]).find("a")
            href = content.get("href")
            # 
            print(f"href {i}:", href)

            CrawlDatasetPlant_Detail(href, file_path)
            
            break

        break

# ---------------------- Process ----------------------

# CrawlDatasetPlant_Detail(r"https://mowgarden.com/cay-trau-ba-de-vuong-xanh-thuy-sinh/", "")


for i, url in enumerate(subUrl):
    main_url = sourceUrl + subUrl[url]
    
    # 
    print(f"{i}: ", main_url)

    # Connection
    soup = ConnectionWithSoup(main_url)
    if soup == "error":
        break

    # ==== Get max page FROM main ====
    soup = soup.find("div", class_=main_container["divcontent"])

    maxpag = soup.find(class_=main_container["divpagination"]).find(class_=main_container["navpagination"]).find_all("li")
    maxpag = maxpag[len(maxpag) - 2].text.strip()

    # 
    print("max pag:", maxpag)    

    CrawlDatasetPlant_Main(main_url, int(maxpag), output_path)

    break


SaveAttributesToCSV()



