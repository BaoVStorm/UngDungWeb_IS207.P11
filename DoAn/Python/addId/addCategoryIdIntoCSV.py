import pandas as pd

input_path = r"D:\Homework\Year3\UngDungWeb_IS207.P11\DoAn\CSV\Pot_AllCategory_.csv"
output_path = r"D:\Homework\Year3\UngDungWeb_IS207.P11\DoAn\CSV"

df_id = pd.read_csv(input_path)

id_category = 38

df_id["id_category"] = 0

def getId():
    global id_category
    category_id = f"CCNCAT{id_category:04d}"
    id_category += 1
    return category_id

for i in range(len(df_id)):
    df_id.at[i, "id_category"] = getId()
    print(df_id["id_category"][i])

df_id.to_csv(output_path + rf"\Pot_AllCategory.csv", index=False, encoding="utf-8-sig")

print("Save successfully")