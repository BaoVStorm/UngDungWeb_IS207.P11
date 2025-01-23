# ---------------------- Library ----------------------
import requests
import pandas as pd
from bs4 import BeautifulSoup

# ---------------------- variable ----------------------
# dynamic
output_path = r"D:\Homework\Year3\UngDungWeb_IS207.P11\DoAn"    # place save scv

headers_plants = ["PLANTID", "CODE", "URL", "TIÊU ĐỀ", "TÊN KHOA HỌC", "TÊN GỌI", "TÊN GỌI KHÁC", "TÊN TIẾNG ANH", "GIÁ", "MÔ TẢ"]
headers_categories = ["CATEGORYID", "PLANTID", "CATEGORY"] 
headers_images = ["IMAGEID", "PLANTID", "IMAGEURL"]
headers_limit_url = ["LIMITPAGE"]

# static
plant_id = 0
image_id = 0
categories_id = 0

df_plants = pd.DataFrame(columns=headers_plants)
df_categories = pd.DataFrame(columns=headers_categories)
df_images = pd.DataFrame(columns=headers_images)
df_limit_url = pd.DataFrame(columns=headers_limit_url)

sourceUrl = "https://mowgarden.com"

subUrl = {
    # "CayTrongNha": "/ban-cay-canh-trong-nha/",
    # "CayNgoaiTroi": "/cay-ngoai-troi/",
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
        info_title -> (title)

        info_price :first -> (price in <bdi>)

        divdesription
            span -> (short description)

            tbody
                tr
                    td -> (description)
                    dt -> (value)
                tr
                    v.v
                v.v

        divmeta
            divsku -> (Code)
        
        divcategory
            a -> (category)
            v.v
'''

# ---------------------- Function ----------------------

def GetPlantID():
    global plant_id
    id_plant = f"CCNPLT{plant_id:04d}"
    plant_id += 1
    return id_plant

def GetImageID():
    global image_id
    id_image = f"CCNIMG{image_id:04d}"
    image_id += 1
    return id_image

def GetCategoryID():
    global categories_id
    id_category = f"CCNCAT{categories_id:04d}"
    categories_id += 1
    return id_category

def Save_CSV(url, image_list, des_list, title, price, description, code, category):
    '''
        image_list = []
        des_list = []
        title = ""
        price = ""
        description = ""
        code = ""
        category = []
    '''

    # --------- Save to plantCSV ---------

    global df_plants
    plantid = GetPlantID()

    new_row = {
        "PLANTID": plantid,
        "TIÊU ĐỀ": title,
        "GIÁ": price,
        "MÔ TẢ": description,
        "CODE": code,
        "URL": url
    }

    for des in des_list:
        des[0] = des[0].upper()

        if des[0].split(" ")[0] == "TÊN":
            if des[0] == "TÊN THÔNG THƯỜNG":
                des[0] = "TÊN GỌI"

            if not des[0] == "TÊN KHOA HỌC" and not des[0] == "TÊN TIẾNG ANH" and not des[0] == "TÊN GỌI":
                des[0] = "TÊN GỌI KHÁC"

        if des[0] == "QUY CÁCH SẢN PHẨ":
            des[0] = "QUY CÁCH SẢN PHẨM"

        if des[0][0] == "`":
            des[0] = des[0][1:]

        if not des[0] in df_plants.columns:
            df_plants[des[0]] = pd.NA
            headers_plants.append(des[0])

        new_row[des[0]] = des[1]

    df_plants = pd.concat([df_plants, pd.DataFrame([new_row])], ignore_index=True)

    # --------- Save to imageCSV ---------
    global df_images
    
    for img in image_list:
        imageid = GetImageID()

        new_image_row = {
            "PLANTID": plantid,
            "IMAGEURL": img,
            "IMAGEID": imageid
        }

        df_images = pd.concat([df_images, pd.DataFrame([new_image_row])], ignore_index=True)

    # --------- Save to categoryCSV ---------

    global df_categories

    for cate in category:
        categoryid = GetCategoryID()

        new_cate_row = {
            "PLANTID": plantid,
            "CATEGORY": cate,
            "CATEGORYID": categoryid
        }

        df_categories = pd.concat([df_categories, pd.DataFrame([new_cate_row])], ignore_index=True)

def ConnectionWithSoup(url):
    # Connection
    try:
        response = requests.get(url)
        response.raise_for_status()  # Kiểm tra mã trạng thái HTTP
    except requests.exceptions.RequestException as e:
        global df_limit_url
        
        print(url)
        print(f"An error occurred: {e}")
        df_limit_url = pd.concat([df_limit_url, pd.DataFrame([{"Limit Page": url}])], ignore_index=True)
        return "error"
    
    # Get soup
    return BeautifulSoup(response.content, "html.parser")

def CrawlDatasetPlant_Detail(url, file_path):
    # Connection
    soup = ConnectionWithSoup(url)
    if soup == "error":
        return

    # ----------- variable -----------
    image_list = []
    des_list = []
    title = ""
    price = ""
    description = ""
    code = ""
    category = []

    # ==== Get information of plant FROM detail page ====
    soup = soup.find("div", class_=detail_container["divcontent"])  

    # 1. Image
    try:
        images = soup.find("div", class_=detail_container["divimage"]).find("figure").contents
    except Exception as e:
        print("** Không có Hình ảnh **")
        return

    del images[0]
    del images[len(images) - 1]

    for image in images:
        image_url = image.find("a").get("href")
        image_list.append(image_url)

    # 2. Info
    infos = soup.find("div", class_=detail_container["divinfo"])

    # title
    try:
        title = infos.find(class_=detail_container["info_title"]).text.strip()
    except Exception as e:
        print("** Không có Title **")
        return
    
    # price
    try:
        price = infos.find(class_=detail_container["info_price"]).find("bdi").text.strip()
    except Exception as e:
        print("** Không có Title **")
        return

    price = price.replace(',', "")
    price = price.replace('.', "")
    price = price[:len(price) - 1]  # xoá ký tự ₫
    
    # description
    divdes = infos.find(class_=detail_container["divdesription"])
    try:
        description = divdes.find("p").text.strip()
    except Exception as e:
        description = ""
    
    # attributes
    try:
        attributes = divdes.find("tbody").contents

        for att in attributes:
            if att.text == "\n":
                attributes.remove(att)

        for att in attributes:
            subatt = att.contents

            for sub in subatt:
                if sub.text == "\n":
                    subatt.remove(sub)

            des_list.append([subatt[0].text.strip(), subatt[1].text.strip()])
    except Exception as e:
        try:
            attributes = divdes.find("ul").contents
            
            for att in attributes:
                if att.text == "\n":
                    attributes.remove(att)

            for att in attributes:
                subatt = att.text.split(":", 1)

                des_list.append([subatt[0].strip(), subatt[1].strip()])
        except Exception as e:
            des_list = []

    # Code
    try:
        code = soup.find(class_=detail_container["divmeta"]).find(class_=detail_container["divsku"]).find("span").text.strip()
    except Exception as e:
        code = ""

    if code == "N/A":
        code = ""

    # category
    try:
        divcategory = soup.find(class_=detail_container["divcategory"]).contents
    except Exception as e:
        print("** Không có category **")
        return

    for cate in divcategory:
        if cate.text == "\n" or cate.text == ", " or cate.text == "":
            divcategory.remove(cate)

    del divcategory[0]  # Xoá "Danh mục:"

    for cate in divcategory:
        category.append(cate.text.strip())

    # Lưu cây vào csv
    Save_CSV(url, image_list, des_list, title, price, description, code, category)

def CrawlDatasetPlant_Main(main_url, maxpag, file_path):
    for i in range(maxpag):

        print(f"\n----------------------- PAGE {i + 1} of {main_url} -----------------------")

        url = main_url + f"page/{i + 1}/"        

        # Connection
        soup = ConnectionWithSoup(url)
        if soup == "error":
            return    

        # ==== Get href to load to detail page FROM main ====
        listcontent = soup.find("div", class_=main_container["divcontent_list"]).contents
        del listcontent[0]

        for j, content in enumerate(listcontent):
            if content.text == "\n":
                continue
            
            content = content.find(class_=main_container["box_image"]).find(class_=main_container["href_plant"]).find("a")
            href = content.get("href")
            # 
            print(f"\nhref {j} of page {i + 1}:", href)

            CrawlDatasetPlant_Detail(href, file_path)
            
            # break

        # break

# ---------------------- Process ----------------------

# CrawlDatasetPlant_Detail(r"https://mowgarden.com/cay-da-tam-phuc-mot-than-chau-uom-ficu059/", "")
# df_plants.to_csv(output_path + rf"\test.csv", index=False, encoding="utf-8-sig")
# df_limit_url.to_csv(output_path + rf"\limit_url.csv", index=False, encoding="utf-8-sig")

df_all_plants = pd.DataFrame()
df_all_limit_url = pd.DataFrame()

for i, url in enumerate(subUrl):
    
    df_all_plants = pd.concat([df_all_plants, df_plants], ignore_index=True)
    df_all_limit_url = pd.concat([df_all_limit_url, df_limit_url], ignore_index=True)

    # ---- reset dataframe ----

    df_plants = df_plants.iloc[0:0]
    df_limit_url = df_limit_url.iloc[0:0]
    
    # -------------------------
    main_url = sourceUrl + subUrl[url]
    
    # 
    print(f"=======> Đang crawl main page thứ {i}: ", main_url, "<=======")

    # Connection
    soup = ConnectionWithSoup(main_url)
    if soup == "error":
        break

    # ==== Get max page FROM main ====
    soup = soup.find("div", class_=main_container["divcontent"])

    maxpag = soup.find(class_=main_container["divpagination"]).find(class_=main_container["navpagination"]).find_all("li")
    maxpag = maxpag[len(maxpag) - 2].text.strip()

    # 
    print(f"Số trang tối đa của page {url} là: ", maxpag)    

    CrawlDatasetPlant_Main(main_url, int(maxpag), output_path)

    df_plants.to_csv(output_path + rf"\PlantOf{url}.csv", index=False, encoding="utf-8-sig")
    df_limit_url.to_csv(output_path + rf"\limit_url_{url}.csv", index=False, encoding="utf-8-sig")
    print(f"\n------------------ Đã crawl và đã lưu dữ liệu thành công Trang {url} ------------------\n")

    # break

df_all_plants.to_csv(output_path + rf"\AllPlant.csv", index=False, encoding="utf-8-sig")
df_all_limit_url.to_csv(output_path + rf"\AllLimitUrl.csv", index=False, encoding="utf-8-sig")
df_categories.to_csv(output_path + rf"\CategoryData.csv", index=False, encoding="utf-8-sig")
df_images.to_csv(output_path + rf"\ImageData.csv", index=False, encoding="utf-8-sig")

print("\n=================== Đã crawl và đã lưu dữ liệu thành công ===================\n")